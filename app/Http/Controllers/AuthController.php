<?php

namespace App\Http\Controllers;

use App\DashboardRoute;
use App\Models\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function validateLogin(Request $request)
    {
        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return back()->with('error', 'Wrong Credentials');
        }

        $user = Auth::user();
        if($user->role == Role::MEMBER){
            abort(404);
        }

        return DashboardRoute::getHomePage($user);
    }
}
