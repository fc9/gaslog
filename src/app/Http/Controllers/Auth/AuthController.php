<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class AuthController extends ApiController
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        $token = $request->query('token');

        if(!$token) {
            return redirect()->route('auth.login');
        }

        $tokenValid = \DB::table('password_resets')->where('token',$token)->first();

        if(!$tokenValid) {
            return view('auth.reset-password', ['tokenValid' => false]);
        } else {
            return view('auth.reset-password', ['tokenValid' => true, 'token' => $token]);
        }
    }

    public function logout()
    {
        \Session::forget('dash');

        auth()->logout();

        return redirect()->route('auth.login');
    }
}
