<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        $role = Auth::user()->role;

        return match ($role) {
            'siswa' => redirect()->intended('/siswa/dashboard'),
            'guru' => redirect()->intended('/guru/dashboard'),
            'bendahara' => redirect()->intended('/bendahara/dashboard'),
            default => redirect()->intended('/dashboard'),
        };
    }
}
