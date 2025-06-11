<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleSiswa
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'siswa') {
            return $next($request);
        }

        abort(403, 'Akses hanya untuk siswa.');
    }
}
