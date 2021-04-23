<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function userOrdersPrice($id){
        return User::find($id)->getTotalUserOrdersPrice();
    }
}
