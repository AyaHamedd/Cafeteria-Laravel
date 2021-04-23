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
            'password'=>['required', 'min:8', 'confirmed'],
            'avatar' => ['required'],
            'room_id' => ['required']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=>Hash::make($request->password),
            'room_id' => $request->room_id,
            'avatar' => $request->avatar
        ]);

    }
}
