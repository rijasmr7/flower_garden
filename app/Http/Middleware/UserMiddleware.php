<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Ensure the user is authenticated and has the 'user' user_type
       if (Auth::check() && Auth::user()->user_type === 'user') {
        return $next($request);
      }

      // Redirect to the user login page if not a user
      return redirect()->route('auth.login')->with('error', 'Unauthorized access.');
    }
}
