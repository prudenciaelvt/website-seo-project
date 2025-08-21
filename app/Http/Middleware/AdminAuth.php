<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah session admin_id ada
        if (!session()->has('admin_id')) {
            // Kalau tidak ada, redirect ke halaman login admin
            return redirect()->route('admin.login');
        }

        // Kalau ada, lanjutkan request
        return $next($request);
    }
}
