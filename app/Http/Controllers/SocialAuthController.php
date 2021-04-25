<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\SocialAccount;


use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider){
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider){
        $user = Socialite::driver($provider)->stateless()->user();
        
        if(!$user->token){
            //return json later
            dd('failed');
        }

        $appUser = User::where('email',$user->email)->first();
        
        if(!$appUser){
            //create user and add a provider
            $appUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password'=>Hash::make(Str::random(7)),
                'avatar' => $user->avatar
            ]);

            $socialAccount = SocialAccount::create([
                'provider'=>$provider,
                'provider_user_id'=>$user->id,
                'user_id'=>$appUser->id
            ]);
        } else {
            //We have already this user
            $socialAccount = $appUser->socialAccounts()->where('provider', $provider)->first();

            if(!$socialAccount){
                //create social account
                $socialAccount = SocialAccount::create([
                    'provider'=>$provider,
                    'provider_user_id'=>$user->id,
                    'user_id'=>$appUser->id
                ]);
            }
        }
        $passportToken = $appUser->CreateToken('login token')->plainTextToken;
        //login our user and get the token
        return response()->json([
            'access_token' => $passportToken
        ]);
        dd($user, $appUser, $passportToken);
    }

}
