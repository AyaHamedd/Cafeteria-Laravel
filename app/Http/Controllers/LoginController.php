<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client;

class LoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => ['required'],
            'password' => ['required'] 
        ]);
            
        $passwordGrantClient = Client::where('password_client', 1)->first();
        $data = [
            'grant_type' => 'password',
            'client_id' => $passwordGrantClient->id,
            'client_secret' => $passwordGrantClient->secret,
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '*',
            ];
            
        $tokenRequest = Request::create('/oauth/token', 'post', $data);
        $tokenResponse = app()->handle($tokenRequest);
        $tokenString = $tokenResponse->content();
        $tokenContent = json_decode($tokenString, true);

        if(!empty($tokenContent['access_token'])){
            return $tokenResponse;
        }

        throw ValidationException::withMessages([
            'email' => ['Credentials are incorrect.']
        ]);

    }

    public function logout(){
        Auth::logout();
    }
}
