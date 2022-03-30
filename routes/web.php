<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;
use App\Models\Admin;
use App\Models\Voter;
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

Route::prefix('admin')->group(function(){

    // SIGNUP
    Route::get('/signup', function () {
        return view('admin.signup');
    });

    Route::post('/signup', function (Request $request) {
        $request->validate([
            'email'=>"email|required|unique:users",
            'fName'=>"required",
            'lName'=>"required",
            "password"=>"required",
            "phone"=>"required|min:8|max:12"
        ]);

        try {
            $admin= Admin::create([
                'firstName'=> $request->fName,
                'lastName'=> $request->lName,
                'email'=> $request->email,
                'phoneNumber'=> $request->phone,
                'password'=>Hash::make($request->password),
                'image'=>0,
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
            // if(!$token){
            //     session()->flash('error', 'Invalid Login Details');
            //     return redirect()->back();
            // }
            $admin = auth()->guard('admin')->user();
            return redirect()->to('admin/dashboard');
         
        } catch (\Throwable $th) {
            session()->flash('error', 'Invalid Login Details');
            return redirect()->back();
        }   
    })->name('adminLogin');

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
    });

    Route::post('/contestant', function(Request $request) {
        $request->validate([
            'contName'=>"required",
            'contInfo'=>"required",
            'image'=>"required"
        ]);
    
        $image = $request->image;
    
        if($image !== null){
            $gen = mt_rand(10000, 90000);
            $ext = $request->image->extension();
            $path= $gen . ".". $ext;
            $show= $request->image->storeAs('image', $path);

            // $fill= Storage::disk("public")->get();
            // dd($fill);
    
            $details= DB::table('contestantDetails')->insert([
                'name'=>$request->contName,
                'information'=>$request->contInfo,
                'image'=>$show
            ]);    
        }
        if($details){
            return "Contestant details updated successfully";
        }
        else{
            return "Error occurred";
        }   
    })->name('contestant');

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
            'email'=>"email|required|unique:users",
            'fName'=>"required",
            'lName'=>"required",
            "password"=>"required",
            "phone"=>"required|min:8|max:12"
        ]);

        try {
            $admin= Voter::create([
                'firstName'=> $request->fName,
                'lastName'=> $request->lName,
                'email'=> $request->email,
                'phoneNumber'=> $request->phone,
                'password'=>Hash::make($request->password),
                'image'=>0,
            ]);
            
            Auth::guard('voter')->loginUsingId($admin->id);
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
            
            // if(!$token){
            //     session()->flash('error', 'Invalid Login Details');
            //     return redirect()->back();
            // }
            $voter = auth()->guard('voter')->user();
            return redirect()->to('voter/dashboard');
         
        } catch (\Throwable $th) {
            session()->flash('error', 'Invalid Login Details');
            return redirect()->back();
        }   
    })->name('voterLogin');

     // DASHBORAD
     Route::get('/dashboard', function(){
        $cont = DB::table('contestantDetails')->get();
        return view('voter.dashboard')->with(['show'=>$cont]);
    });

    Route::post('/dashboard', function(){
        $validateVoter = auth()->guard('voter')->user()->id;
        dd($validateVoter);

        return view('voter.dashboard');
        try {
            //code...
        } catch (\Throwable $th) {
            return "error";
        }
    })->name('vote');
});


// CONTESTANT
Route::prefix('contestant')->group(function(){

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

Route::get('auth/redirect', 'App\Http\Controllers\SocialController@redirect');
Route::get('auth/callback', 'App\Http\Controllers\SocialController@callback');


// PAYPAL
Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');