<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleBendahara
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'bendahara') {
            return $next($request);
        }

        abort(403, 'Akses hanya untuk bendahara.');
    }
}
