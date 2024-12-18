<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserLoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('userside.login');
    }

    // Handle the login process
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role === 'user') {
                return redirect()->route('userside.index');
            }

            // If the user is not a "user", logout and show an error
            Auth::logout();
            return redirect()->route('user.login')->with('error', 'You cannot log in as a user.');
        }

        // Invalid credentials or any other error
        return redirect()->route('user.login')->with('error', 'Invalid email or password.');
    }
}


