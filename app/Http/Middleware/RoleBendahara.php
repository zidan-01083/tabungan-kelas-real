<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; // Tambahkan ini untuk tipe hinting yang lebih baik
use Illuminate\Support\Facades\Auth;

class RoleBendahara
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Memeriksa apakah pengguna sudah terautentikasi dan memiliki peran 'bendahara'
        if (Auth::check() && Auth::user()->role === 'bendahara') {
            // Jika ya, lanjutkan request
            return $next($request);
        }

        // Jika tidak, abaikan akses dengan HTTP status 403 (Forbidden)
        abort(403, 'Akses ditolak. Hanya bendahara yang diperbolehkan.');
    }
}