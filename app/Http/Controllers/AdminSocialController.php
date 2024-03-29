<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AdminSocialController extends Controller
{
    public function redirect()
{
    return Socialite::driver('google')->redirect();
}

public function callback()
{
    try {
        
        $user = Socialite::driver('google')->stateless()->user();
        dd($user);
        $admin= Admin::where('email', $user->email)->first();
        
        $findAdmin = Admin::where('google_id', $user->id)->first();
    

        $duplicateEmail = Admin::where('email', $user->email)->first();

            if($findAdmin){
                Auth::guard('admin')->login($findAdmin);
                $admin = auth()->guard('admin')->user();
                return redirect('/admin/dashboard');
            }
            elseif($duplicateEmail){
                Auth::guard('admin')->loginUsingId($admin->id);
                $admin = auth()->guard('admin')->user();
                return redirect('/admin/dashboard');
            }else{
                $newUser = Admin::insert([
                    'firstName' => $user->user['given_name'],
                    'lastName' => $user->user['family_name'],
                    'email' => $user->user['email'],
                    'google_id'=> $user->id,
                    'image'=> 0,
                    'phoneNumber'=>'',
                    'password' => Hash::make('123456dummy'),
                    'remember_token'=>'',
                    'created_at'=>now()
                ]);
                
                Auth::guard('admin')->loginUsingId($newUser->id);
                $admin = auth()->guard('admin')->user();
                return redirect('/admin/dashboard');
            }
        } catch (Exception $e) {
            return "error";
        }
   }
}

