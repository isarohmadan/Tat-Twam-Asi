<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class KetuaYayasanMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'ketua_yayasan') {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Bukan ketua yayasan');
    }
}
