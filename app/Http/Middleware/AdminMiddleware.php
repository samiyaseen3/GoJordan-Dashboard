<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next , $role)
    {
        // Check if the user is authenticated and has an 'admin' role
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // If not an admin, redirect to the login page or show an access denied message
        return redirect()->route('admin.login')->withErrors(['access' => 'Access Denied: Admins Only']);
    }
}

