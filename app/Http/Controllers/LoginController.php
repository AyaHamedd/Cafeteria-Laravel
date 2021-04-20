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
            return response()->json(Auth::user(), 200);
        }

        throw ValidationException::withMessages([
            'email' => ['Credentials are incorrect.']
        ]);

    }

    public function logout(){
        Auth::logout();
    }
}
