<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function validateLogin(Request $request){

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->with('error', 'Wrong Credentials');
        }

        $user = Auth::user();
    }
}
