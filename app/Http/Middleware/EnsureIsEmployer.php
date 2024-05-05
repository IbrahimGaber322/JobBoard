<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureIsEmployer
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'employer') {
            return redirect('/')->with('error', 'You are not authorized to access this area.');
        }

        return $next($request);
    }
}
