<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\PaystackController;
use App\Models\Admin;
use App\Models\Contestant;
use App\Models\ContestantDetail;
use App\Models\Payment;
use App\Models\Votepayment;
use App\Models\Voter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// LANDING PAGE //
Route::get('/', function () {
    return view('welcome');
});

// ADMIN
Route::prefix('admin')->group(function(){
    
    // SIGNUP
    Route::get('/signup', function () {
        return view('admin.signup');
    });

    Route::post('/signup', function (Request $request) {
        $request->validate([
            'email'=>"email|required|unique:admins",
            'first_name'=>"required",
            'last_name'=>"required",
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required',
            "phone_number"=>"required|min:11|max:11"
        ]);
        
        try {
            $admin= Admin::create([
                'firstName'=> $request->first_name,
                'lastName'=> $request->last_name,
                'email'=> $request->email,
                'phoneNumber'=> $request->phone_number,
                'password'=>Hash::make($request->password),
            ]);
            
            Auth::guard('admin')->loginUsingId($admin->id);
            return redirect('admin/login');
        } catch (\Throwable $th) {
            return "error";
        }

    })->name('adminSignup');


    // LOGIN
    Route::get('/login', function () {
        return view('admin.login');
    });

    Route::post('/login', function (Request $request) {
        $request->validate([
            'email'=>"required|email",
            'password'=>"required"
        ]);

        try {
            $token = Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password],true);
            $admin = auth()->guard('admin')->user();
            if(!$token){
                session()->flash('error', 'Invalid Login Details');
                return redirect()->back();
            }
            return redirect()->to('admin/dashboard');
         
        } catch (\Throwable $th) {
            session()->flash('error', 'Invalid Login Details');
            return redirect()->back();
        }   
    })->name('adminLogin');

    // GOOGLE SOCIALITE
    Route::get('/auth/redirect', 'App\Http\Controllers\AdminSocialController@redirect');
   
    // FORGET PASSWORD --RESET PASSWORD
    Route::get('/password/request', function(){
        return view('admin.password.request');
    })->name('adminRequest');

    Route::post('/password/request', function(Request $request){
        $request->validate([
            'email'=> 'required|email|exists:admins,email'
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email'=> $request->email,
            'token'=>$token,
            'created_at'=> Carbon::now()
        ]);

        $action_link= route('admin.password.reset', ['token'=>$token, 'email'=>$request->email]);
        $body= "We have received a request to reset the password for <b> Global Talent</b> account associated with
        ".$request->email." as an Admin. You can reset your password by clicking the link below";

        Mail::send('admin.email_forgot', ['action_link'=>$action_link, 'body'=>$body], function($message) use ($request){
            $message->from('agbesuaoluwatoyin96@gmail.com', 'Global Talent');
            $message->to($request->email, 'Your name')
                    ->subject('Reset Password');
        });
        

        return back()->with('success', 'We have e-mailed your password reset link!');
    })->name('admin_send_password');

    Route::get('/password/reset/{token}', function(Request $request, $token=null){
        return view('admin.password.reset')->with(['token'=>$token, 'email'=>$request->email]);
    })->name('admin.password.reset');

    Route::post('/password/reset', function(Request $request){
        $request->validate([
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required'
        ]);

        $check_token = DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if(!$check_token){
            return back()->withInput()->with('fail', 'Invalid Token');
        }else{
            Admin::where('email', $request->email)->update([
                'password'=> Hash::make($request->password)
            ]);

            DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();
            
            return redirect()->to('admin/login')
            ->with('info', 'Your password has been changed! You can now login with the new password')
            ->with(['verifiedEmail'=>$request->email]);
        }
    })->name('adminResetPassword');

    // END FORGET PASSWORD --RESET PASSWORD

    // ADMIN LOGOUT
    Route::get('/logout', function(Request $request){
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('admin/login')
        ->with('log', "You've successfully logout! Enter your details to login");
    })->name('adminLogout');

    
    // DASHBOARD
    Route::get('/dashboard', function(){
        $validateAdmin = auth()->guard('admin')->user()->id;

        $a = auth()->guard('admin')->user()->firstName;
        $b = auth()->guard('admin')->user()->lastName;
        $first= substr($a,0,1);
        $sec= substr($b,0,1);
        $data = DB::table('admins')
        ->where('id', $validateAdmin)
        ->get();

        return view('admin.dashboard')->with(['data'=>$data, 'first'=>$first, 'sec'=>$sec]);
    });

    // CONTESTANT
    Route::get('/contestant', function(){
        $cont = DB::table('contestantDetails')->get();
        
        $validateAdmin = auth()->guard('admin')->user()->id;

        $a = auth()->guard('admin')->user()->firstName;
        $b = auth()->guard('admin')->user()->lastName;
        $first= substr($a,0,1);
        $sec= substr($b,0,1);
        $data = DB::table('admins')
        ->where('id', $validateAdmin)
        ->get();

        return view('admin.contestant')->with(['data'=>$data, 'first'=>$first, 'sec'=>$sec, 'show'=>$cont]);
    })->name('contestant');

    Route::post('/contestant', function(Request $request) {
        $request->validate([
            'contestant_name'=>"required",
            'contestant_information'=>"required",
            'image'=>"required|mimes:png,jpg,jpeg|max:5048",
            'contestant_email'=>'required|email',
            'code'=>'required'
        ]);
        
        try {
            $image = $request->image;
    
            if($image !== null){
                $gen = mt_rand(10000, 90000);
                $ext = $request->image->extension();
                $path= $gen . ".". $ext;
                $show= $request->image->move(public_path('images'), $path);

                $details= DB::table('contestantDetails')->insert([
                    'name'=>$request->contestant_name,
                    'information'=>$request->contestant_information,
                    'image'=>$path,
                    'contestantEmail'=>$request->contestant_email,
                    'trackingNumber'=>$request->code,
                    'created_at' =>now(),
                    'updated_at' => null
                ]);    
                
            }
            if($details){
                session()->flash('success', 'Contestant details updated successfully');
                return redirect('admin/contestant');
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Invalid Login Details');
            return redirect()->back();
        } 
    })->name('contestantForm');

    // EDIT CONTESTANT FORM
    Route::get('/edit-contestant/{id}', function($id){
        // VALIDATE ADMIN
        $validateAdmin = auth()->guard('admin')->user()->id;

        $a = auth()->guard('admin')->user()->firstName;
        $b = auth()->guard('admin')->user()->lastName;
        $first= substr($a,0,1);
        $sec= substr($b,0,1);
        $data = DB::table('admins')
                ->where('id', $validateAdmin)
                ->get();

        try {
            $check= DB::table('contestantDetails')->where('id', $id)->first();

        
            // RETURN VIEW
            return view('admin.edit-contestant')->with(['dataa'=>$check, 'data'=>$data, 'first'=>$first, 'sec'=>$sec]);
        } catch (\Throwable $th) {
            session()->flash('error', 'Error Occurred');
            return redirect()->back();
        }
    });

    Route::post('/edit-contestant', function(Request $request){
        $validateAdmin = auth()->guard('admin')->user();
        $i = Contestantdetail::where('id', $request->id)->first();
        
       if($validateAdmin){
            try {        
                $data= Contestantdetail::find($request->id);
                $data->name=$request->contestant_name;
                $data->information=$request->contestant_information;
                $data->contestantEmail=$request->contestant_email;
                $data->updated_at=now();
                $data->trackingNumber=$request->code;
                $data->created_at= $i->created_at;
                $data->image=$i->image;
                $data->save();
                
                session()->flash('success', 'Contestant details updated successfully');
                return redirect('admin/contestant');
                
            } catch (\Throwable $th) {
                session()->flash('error', 'Error Occurred');
                return redirect()->back();
            }
       }
    })->name('update');

    // VIEW CONTESTANT FORM
    Route::get('/view-contestant/{id}', function($id){
        // VALIDATE ADMIN
        $validateAdmin = auth()->guard('admin')->user()->id;

        $a = auth()->guard('admin')->user()->firstName;
        $b = auth()->guard('admin')->user()->lastName;
        $first= substr($a,0,1);
        $sec= substr($b,0,1);
        $data = DB::table('admins')
                ->where('id', $validateAdmin)
                ->get();

        try {
            $check= DB::table('contestantDetails')->where('id', $id)->first();

        
            // RETURN VIEW
            return view('admin.view-contestant')->with(['dataa'=>$check, 'data'=>$data, 'first'=>$first, 'sec'=>$sec]);
        } catch (\Throwable $th) {
            session()->flash('error', 'Error Occurred');
            return redirect()->back();
        }
    });

    // DELETE CONTESTANT FORM
    Route::post('delete-contestant/{id}', function(Request $request, $id){
       try {
            $contestant = DB::table('contestantDetails')
            ->where('id',$id)            
            ->delete();

            echo session()->flash('success', 'Contestant details deleted successfully');
            return redirect('admin.contestant');
       } catch (\Throwable $th) {
           //throw $th;
       }
    })->name('delete-contestant');


    // PROFILE

    Route::get('/profile', function(){
        $validateAdmin = auth()->guard('admin')->user()->id;

        $a = auth()->guard('admin')->user()->firstName;
        $b = auth()->guard('admin')->user()->lastName;
        $first= substr($a,0,1);
        $sec= substr($b,0,1);
        $data = DB::table('admins')
        ->where('id', $validateAdmin)
        ->get();

        return view('admin.profile')->with(['data'=>$data, 'first'=>$first, 'sec'=>$sec]);
    });

    Route::get('/adminNav', function(){
        $validateAdmin = auth()->guard('admin')->user()->id;

        $a = auth()->guard('admin')->user()->firstName;
        $b = auth()->guard('admin')->user()->lastName;
        $first= substr($a,0,1);
        $sec= substr($b,0,1);
        $data = DB::table('admins')
        ->where('id', $validateAdmin)
        ->get();

        return view('include.adminNav')->with(['data'=>$data, 'first'=>$first, 'sec'=>$sec]);
    });
});

// VOTERS

Route::prefix('voter')->group(function(){
    // SIGNUP
    Route::get('/signup', function () {
        return view('voter.signup');
    });

    Route::post('/signup', function (Request $request) {
        $request->validate([
            'email'=>"email|required|unique:voters",
            'first_name'=>"required",
            'last_name'=>"required",
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required',
            "phone_number"=>"required|min:11|max:11"
        ]);
        
        try {
            $voter= Voter::create([
                'firstName'=> $request->first_name,
                'lastName'=> $request->last_name,
                'email'=> $request->email,
                'phoneNumber'=> $request->phone_number,
                'password'=>Hash::make($request->password),
            ]);
            
            Auth::guard('voter')->loginUsingId($voter->id);
            return redirect('voter/login');
        } catch (\Throwable $th) {
            return "error";
        }

    })->name('voterSignup');

    // LOGIN
    Route::get('/login', function () {
        return view('voter.login');
    });

    Route::post('/login', function (Request $request) {
        $request->validate([
            'email'=>"required|email",
            'password'=>"required"
        ]);

        try {
            $token = Auth::guard('voter')->attempt(['email'=>$request->email, 'password'=>$request->password],true);
            $voter = auth()->guard('voter')->user();

            if(!$token){
                session()->flash('error', 'Invalid Login Details');
                return redirect()->back();
            }
            return redirect()->to('voter/dashboard');
         
        } catch (\Throwable $th) {
            session()->flash('error', 'Invalid Login Details');
            return redirect()->back();
        }   
    })->name('voterLogin');

    // GOOGLE SOCIALITE
    Route::get('/auth/redirect', 'App\Http\Controllers\VoterSocialController@redirect');

    // FORGET PASSWORD --RESET PASSWORD
    Route::get('/password/request', function(){
        return view('voter.password.request');
    })->name('voterRequest');

    Route::post('/password/request', function(Request $request){
        $request->validate([
            'email'=> 'required|email|exists:voters,email'
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email'=> $request->email,
            'token'=>$token,
            'created_at'=> Carbon::now()
        ]);

        $action_link= route('voter.password.reset', ['token'=>$token, 'email'=>$request->email]);
        $body= "We have received a request to reset the password for <b> Global Talent</b> account associated with
        ".$request->email." as a Voter. You can reset your password by clicking the link below";

        Mail::send('voter.email_forgot', ['action_link'=>$action_link, 'body'=>$body], function($message) use ($request){
            $message->from('agbesuaoluwatoyin96@gmail.com', 'Global Talent');
            $message->to($request->email, 'Your name')
                    ->subject('Reset Password');
        });
        

        return back()->with('success', 'We have e-mailed your password reset link!');
    })->name('voter_send_password');

    Route::get('/password/reset/{token}', function(Request $request, $token=null){
        return view('voter.password.reset')->with(['token'=>$token, 'email'=>$request->email]);
    })->name('voter.password.reset');

    Route::post('/password/reset', function(Request $request){
        $request->validate([
            'email'=>'required|email|exists:voters,email',
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required'
        ]);

        $check_token = DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if(!$check_token){
            return back()->withInput()->with('fail', 'Invalid Token');
        }else{
            Voter::where('email', $request->email)->update([
                'password'=> Hash::make($request->password)
            ]);

            DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();
            
            return redirect()->to('voter/login')
            ->with('info', 'Your password has been changed! You can now login with the new password')
            ->with(['verifiedEmail'=>$request->email]);
        }
    })->name('contestantResetPassword');

    // END FORGET PASSWORD --RESET PASSWORD

    // VOTER LOGOUT
    Route::get('/logout', function(Request $request){
        auth()->guard('voter')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('voter/login')
        ->with('log', "You've successfully logout! Enter your details to login");
    })->name('voterLogout');

    // DASHBORAD
    Route::get('/dashboard', function(){
       
        $cont = DB::table('contestantDetails')->get();
        $voter = auth()->guard('voter')->user();
        return view('voter.dashboard')->with(['show'=>$cont, 'voter'=>$voter]);
    });

    // VOTE PAYMENT WITH PAYPAL
    Route::post('/dashboard', function(Request $request){
        $validateVoter = auth()->guard('voter')->user()->id;

        try {
            DB::beginTransaction();
            $payment= Votepayment::create([
                'contestantName'=> $request->contestant,
                'user_id'=> $validateVoter,
                'modeOfPayment'=>'',
                'created_at' =>now(),
            ]);
    
            DB::commit();
        } catch (\Throwable $th) {
        //throw error
            DB::rollBack();
        }
    })->name('paypal');
    

    // VOTE PAYMENT WITH PAYSTACK   
    Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');
});


// CONTESTANT
Route::prefix('contestant')->group(function(){

     // GOOGLE SOCIALITE
    Route::get('/auth/redirect', 'App\Http\Controllers\ContestantSocialController@redirect');
    
    // CONTESTANT SIGNUP
    Route::get('/signup', function () {
        return view('contestant.signup');
    });

    Route::post('/signup', function (Request $request) {
        $request->validate([
            'email'=>"email|required|unique:contestants|exists:contestantdetails,contestantEmail",
            'first_name'=>"required",
            'last_name'=>"required",
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required',
            "phone_number"=>"required|min:11|max:11"
        ]);
        
        try {
            // $a = Contestant::first();
            // dd($a);
            $contestant= Contestant::create([
                'firstName'=> $request->first_name,
                'lastName'=> $request->last_name,
                'email'=> $request->email,
                'phoneNumber'=> $request->phone_number,
                'password'=>Hash::make($request->password),
            ]);
            Auth::guard('contestant')->loginUsingId($contestant->id);
            return redirect('contestant/login');
        } catch (\Throwable $th) {
            return "error";
        }

    })->name('contestantSignup');

    // CONTESTANT LOGIN
    Route::get('/login', function () {
        return view('contestant.login');
    });

    Route::post('/login', function (Request $request) {
        $request->validate([
            'email'=>"required|email",
            'password'=>"required"
        ]);

        try {
            $token = Auth::guard('contestant')->attempt(['email'=>$request->email, 'password'=>$request->password],true);
            $contestant = auth()->guard('contestant')->user();

            if(!$token){
                session()->flash('error', 'Invalid Login Details');
                return redirect()->back();
            }
            return redirect()->to('contestant/dashboard');
         
        } catch (\Throwable $th) {
            session()->flash('error', 'Invalid Login Details');
            return redirect()->back();
        }   
    })->name('contestantLogin');

    // FORGET PASSWORD --RESET PASSWORD
    Route::get('/password/request', function(){
        return view('contestant.password.request');
    })->name('contestantRequest');

    Route::post('/password/request', function(Request $request){
        $request->validate([
            'email'=> 'required|email|exists:contestants,email'
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email'=> $request->email,
            'token'=>$token,
            'created_at'=> Carbon::now()
        ]);

        $action_link= route('contestant.password.reset', ['token'=>$token, 'email'=>$request->email]);
        $body= "We have received a request to reset the password for <b> Global Talent</b> account associated with
        ".$request->email." as a Contestant. You can reset your password by clicking the link below";

        Mail::send('contestant.email_forgot', ['action_link'=>$action_link, 'body'=>$body], function($message) use ($request){
            $message->from('agbesuaoluwatoyin96@gmail.com', 'Global Talent');
            $message->to($request->email, 'Your name')
                    ->subject('Reset Password');
        });
        

        return back()->with('success', 'We have e-mailed your password reset link!');
    })->name('contestant_send_password');

    Route::get('/password/reset/{token}', function(Request $request, $token=null){
        return view('contestant.password.reset')->with(['token'=>$token, 'email'=>$request->email]);
    })->name('contestant.password.reset');

    Route::post('/password/reset', function(Request $request){
        $request->validate([
            'email'=>'required|email|exists:contestants,email',
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required'
        ]);

        $check_token = DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if(!$check_token){
            return back()->withInput()->with('fail', 'Invalid Token');
        }else{
            Contestant::where('email', $request->email)->update([
                'password'=> Hash::make($request->password)
            ]);

            DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();
            
            return redirect()->to('contestant/login')
            ->with('info', 'Your password has been changed! You can now login with the new password')
            ->with(['verifiedEmail'=>$request->email]);
        }
    })->name('voterResetPassword');

    // END FORGET PASSWORD --RESET PASSWORD

     // CONTESTANT LOGOUT
     Route::get('/logout', function(Request $request){
        auth()->guard('contestant')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('contestant/login')
        ->with('log', "You've successfully logout! Enter your details to login");
    })->name('contestantLogout');


    // DASHBORAD
    Route::get('/dashboard', function(){
        
        return view('contestant.dashboard');
    });
});


Route::get('/adminNav', function () {
    return view('include.adminNav');
});

Route::get('/voterNav', function () {
    return view('include.voterNav');
});

// VOTE //

Route::get('/vote', function () {
    return view('vote');
});

Route::post('/vote', function () {
    return "Hello";
});


// LOGIN

Route::get('/voterLogin', function () {
    return view('voterLogin');
});

// DASHBOARD

Route::get('/voterDash', function () {
    return view('voterDash');
});

Route::get('google',function(){
    return view('googleAuth');  
});

// Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
// Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');

// Route::get('auth/redirect', 'App\Http\Controllers\SocialController@redirect');
// Route::get('auth/callback', 'App\Http\Controllers\SocialController@callback');


// PAYPAL
Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

// PAYSTACK
Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback'])->name('payment');

// ADMIN GOOGLE LOGIN
Route::get('auth/google/callback', 'App\Http\Controllers\AdminSocialController@callback');

// VOTER GOOGLE LOGIN
Route::get('auth/google/callback', 'App\Http\Controllers\VoterSocialController@callback');

// CONTESTANT GOOGLE LOGIN
Route::get('auth/google/callback', 'App\Http\Controllers\ContestantSocialController@callback');