<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class VoterSocialController extends Controller
{
    public function redirect()
{
    return Socialite::driver('google')->redirect();
}

public function callback()
{
    try {
        
        $user = Socialite::driver('google')->stateless()->user();
        
        $findVoter = Voter::where('google_id', $user->id)->first();

        $duplicateEmail = Voter::where('email', $user->email)->first();

            if($findVoter){
                Auth::guard('voter')->login($findVoter);
                $voter = auth()->guard('voter')->user();
                return redirect('/voter/dashboard');
            }else{
                $newUser = Voter::insert([
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
                
                Auth::guard('voter')->login($newUser);
                $voter = auth()->guard('voter')->user();
                return redirect('/voter/dashboard');
            }
        } catch (Exception $e) {
            return "error";
        }
   }
}
