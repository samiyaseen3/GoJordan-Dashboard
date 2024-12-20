<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        
        if (!Auth::check()) {
           
            return redirect()->route('user.login');
        }

        // Check if user has the required role
        if (Auth::user()->role === $role) {
            return $next($request);
        }

       
        abort(403, 'You do not have permission to access this page.');
    }
}