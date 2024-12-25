<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('userside.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role === 'user') {
                // Check for tour_id and tour_date_id in request
                if ($request->has('tour_id') && $request->has('tour_date_id')) {
                    return redirect()->route('booking.page', [
                        'tour_id' => $request->tour_id,
                        'tour_date_id' => $request->tour_date_id
                    ]);
                }
                return redirect()->route('userside.index');
            }

            Auth::logout();
            return redirect()->route('user.login')->with('error', 'You cannot log in as a user.');
        }

        return redirect()->route('user.login')->with('error', 'Invalid email or password.');
    }
}

