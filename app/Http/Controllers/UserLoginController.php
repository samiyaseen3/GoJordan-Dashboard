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
        // التحقق من المدخلات
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // محاولة تسجيل الدخول
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            // تحقق من الدور وتوجيه المستخدم بناءً عليه
            if (Auth::user()->role == 'user') {
                // إذا كان مستخدمًا، يوجه إلى صفحة المستخدم
                return redirect()->route('user_index');
            } else {
                // إذا كان دور المستخدم ليس 'user' (مثل admin)، قم بتسجيل الخروج وعرض رسالة خطأ
                Auth::logout();
                return redirect()->route('user.login')->with('error', 'لا يمكنك تسجيل الدخول كمستخدم.');
            }
        }

        // إذا فشل تسجيل الدخول، عرض رسالة خطأ
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
