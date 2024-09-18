<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
