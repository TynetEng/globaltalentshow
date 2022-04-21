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
        
        // var_dump(($user->id));
        $findVoter = Voter::where('google_id', $user->id)->first();
        // var_dump($findVoter);

        $duplicateEmail = Voter::where('email', $user->email)->first();
        // dd($duplicateEmail);

            if($findVoter){
                // return "hi";
                Auth::guard('voter')->login($findVoter);
                return redirect('/voter/dashboard');
            }else{
                // return "hello";
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
                return redirect('/voter/dashboard');
            }
        } catch (Exception $e) {
            // dd($e->getMessage());
            return "error";
        }
   }
}
