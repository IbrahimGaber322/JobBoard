<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Optionally, redirect to home or login page
            return redirect('/')->with('error', 'You are not authorized to access this area.');
        }

        return $next($request);
    }
}

