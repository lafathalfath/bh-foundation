<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'username_or_email' => 'required|string',
            'password' => 'required|string'
        ], [
            'username_or_email.required' => 'Username or Email required',
            'password.required' => 'Password required'
        ]);
        $user = null;
        if (strpos($request->username_or_email, '@')) $user = User::where('email', $request->username_or_email)->first();
        else $user = User::where('name', $request->username_or_email)->first();
        if (!$user) return back()->withErrors('User not found');
        $is_password_valid = Hash::check($request->password, $user->password);
        if (!$is_password_valid) return back()->withErrors('Invalid password');
        Auth::attempt([
            'email' => $user->email,
            'password' => $request->password
        ]);
        return redirect()->route('admin.dashboard')->with('success', 'Login Successful!');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('auth.login.view')->with('success', 'Logout Successful!');
    }

    // public function forgotPasswordView() {
    //     return view('auth.forgot-password');
    // }

    // public function resetPassword($token, Request $request) {
    //     Crypt::d
    // }
}
