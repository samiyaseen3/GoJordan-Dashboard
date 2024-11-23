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
        // Check if user is logged in and has the required role
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // If the user is not authorized, abort with 403 Forbidden
        abort(403, 'You do not have permission to access this page.');
    }
}
