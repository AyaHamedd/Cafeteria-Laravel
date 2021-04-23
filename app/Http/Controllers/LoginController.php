<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => ['required'],
            'password' => ['required'] 
        ]);
        
        if(Auth::attempt($request->only('email', 'password'))){
            $user = Auth::user();
            $token = $user->CreateToken('token')->plainTextToken;
            $cookie = \cookie('jwt', $token, 60*24);
            return \response([
                'jwt'=>$token
            ])->withCookie($cookie);
        }

        throw ValidationException::withMessages([
            'email' => ['Credentials are incorrect.']
        ]);

    }

    public function logout(){
        Auth::logout();
    }
}
