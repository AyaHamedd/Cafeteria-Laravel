<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response ;

class RegisterController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password'=>['required', 'min:8', 'confirmed']
        ]);

        $user = User::create(
            $request->only('name', 'email')
            +['password'=>Hash::make($request->input('password'))]
        );

        return response($user, RESPONSE::HTTP_CREATED);
    }
}
