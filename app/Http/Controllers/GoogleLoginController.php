<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleLoginController extends Controller 
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handle(){
        try{
            $user= Socialite::driver('google')->user();
            $findUser = User::where('google_id', $user->id)->first();
            if($findUser){
                Auth::login($findUser);
                return redirect()->intended('voterDash');
            }
            else{
                $newUser = User::create([
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'google_id'=>$user->id,
                    'password'=>encrypt('123456')
                ]);

                
                Auth::login($newUser);
                return redirect()->intended('voterDash');
            }
        }
        catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
