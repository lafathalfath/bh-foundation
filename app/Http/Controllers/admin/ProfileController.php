<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index () {
        $user = Auth::user();
        return view('admin.profile.index', [
            'user' => $user
        ]);
    }

    public function update (Request $req) {
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email'
        ]);
        $user = User::find(Auth::user()->id);
        $user->update([
            'name' => $req->name,
            'email' => $req->email
        ]);
        return redirect()->route('manage.profile')->with('success', 'Profile Updated Successfully');
    }
    
    public function resetPassword (Request $req) {
        $req->validate([
            'password' => 'required|string',
            'new_password' => 'required|string|confirmed',
        ]);
        $user = User::find(Auth::user()->id);
        $is_password_valid = Hash::check($req->password, $user->password);
        if (!$is_password_valid) return back()->withErrors('password invalid');
        $user->update([
            'password' => Hash::make($req->new_password)
        ]);
        return redirect()->route('manage.profile')->with('success', 'Password Reset Successful');
    }
}
