<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect based on user role
            switch ($user->role) {
                case 'Admin':
                    return redirect()->intended('admin');
                case 'partner':
                    return redirect()->intended('partnerPages');
                default:
                    Auth::logout();
                    return back()->with('loginError', 'Role not found!');
            }
        }

        return back()->with('loginError', 'Login Gagal!!');
    }

    public function register()
    {
        return view('account.register');
    }
}
