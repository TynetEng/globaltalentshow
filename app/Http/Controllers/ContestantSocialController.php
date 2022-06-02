<?php

namespace App\Http\Controllers;

use App\Models\Contestant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class ContestantSocialController extends Controller
{
    public function redirect()
{
    return Socialite::driver('google')->redirect();
}

public function callback()
{
    try {
        
        $user = Socialite::driver('google')->stateless()->user();
        
        $findContestant = Contestant::where('google_id', $user->id)->first();

        $duplicateEmail = Contestant::where('email', $user->email)->first();

            if($findContestant){
                Auth::guard('contestant')->login($findContestant);
                $contestant = auth()->guard('contestant')->user();
                return redirect('/contestant/dashboard');
            }else{
                $newUser = Contestant::insert([
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
                
                
                Auth::guard('contestant')->login($newUser);
                $contestant = auth()->guard('contestant')->user();
                return redirect('/contestant/dashboard');
            }
        } catch (Exception $e) {
            return "error";
        }
   }
}

