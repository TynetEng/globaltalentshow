<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;


class SocialController extends Controller
{
    public function redirect()
{
    return Socialite::driver('google')->redirect();
}

public function callback()
{
    try {
            $user = Socialite::driver('google')->user();
            $user = Admin::where('google_id', $user->id)->first();

            if($user){
                Auth::login($user);
                return redirect('/home');
            }else{
                $newUser = Admin::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);
                Auth::login($newUser);
                return redirect('/home');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
   }
}
