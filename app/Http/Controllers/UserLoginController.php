<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class UserLoginController extends Controller
{
    // عرض نموذج تسجيل الدخول للمستخدمين
    public function showLoginForm()
    {
        return view('user.login');
    }

    // التعامل مع عملية تسجيل الدخول
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role == 'user') {
                // Check for tour_id and tour_date_id in query parameters
                if ($request->has('tour_id') && $request->has('tour_date_id')) {
                    return redirect()->route('booking.page', [
                        'tour_id' => $request->tour_id,
                        'tour_date_id' => $request->tour_date_id
                    ]);
                }
                return redirect()->route('user_index');
            }
            
            Auth::logout();
            return redirect()->route('user.login')
                ->with('error', 'لا يمكنك تسجيل الدخول كمستخدم.');
        }
    
        throw ValidationException::withMessages([
            'email' => ['المعطيات التي قدمتها غير صحيحة.'],
        ]);
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
