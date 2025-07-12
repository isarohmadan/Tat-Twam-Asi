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

        // Redirect ke home dengan pesan error tanpa logout otomatis
        return redirect()->route('home')->with('error', 'Akses ditolak, Anda bukan Ketua Yayasan');
    }
}
