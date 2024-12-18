<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login submission
    public function login(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to login with provided credentials
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('user_index');  // Redirect to user dashboard or home
        }

        // If authentication fails, redirect back with error message
        return back()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
