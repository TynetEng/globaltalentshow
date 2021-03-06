<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Admin;

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

        $admin= Admin::create([
            'first name'=> $request->fName,
            'last name'=> $request->lName,
            'email'=> $request->email,
            'phone number'=> $request->phone,
            'password'=>Hash::make($request->password),
            'image'=>0
        ]);
        
        Auth::loginUsingId($admin->id);
        return redirect('admin/login');

    })->name('adminSignup');


    // LOGIN
    Route::get('/login', function () {
        return view('admin.login');
    });

    Route::post('/login', function (Request $request) {
        try {
            $request->validate([
                'email'=>"required",
                'password'=>"required"
            ]);
    
            $token = Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password],true);
        
    
            if(!$token){
                session()->flash('error', 'Invalid Login Details');
                return redirect()->back();
            }
         
            return redirect()->to('admin/dashboard');
         
        } catch (\Throwable $th) {
            return "error";
        }   
    })->name('adminLogin');


    // DASHBOARD

    Route::get('/dashboard', function(){
        return view('admin.dashboard');
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



Route::get('/contestants', function () {
    
    $cont = DB::table('contestants')->get();
    
    return view('contestants')->with(['show'=>$cont]);
});

Route::post('/contestants', function(Request $request) {
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

        $details= DB::table('contestants')->insert([
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

    
})->name('contestants');

Route::get('google',function(){
    return view('googleAuth');  
});

Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');

