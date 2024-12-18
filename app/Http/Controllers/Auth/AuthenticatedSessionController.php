<?php

namespace App\Http\Controllers\Auth;


use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        
        $validator = Validator::make($credentials, [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt($credentials)) {
           
            $request->session()->regenerate();

            return redirect()->route('dashboard.index');
        }

        
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $userRole = Auth::user()->role;
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($userRole === 'admin') {
            return redirect()->route('admin.login')->with('message', 'Logged out successfully.');
        }

        return redirect('user_index');
    }

    protected function authenticated(Request $request, $user)
{
    
    if ($user->role === 'admin') {
       
        return redirect()->route('dashboard.index');
    }

    // Redirect non-admin users to an error page
    return abort(403, 'Access denied.');
}
}

