<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse; // Import RedirectResponse for the destroy method

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
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
            'siswa' => redirect()->intended(route('siswa.dashboard')),
            'guru' => redirect()->intended(route('guru.dashboard')),
            'bendahara' => redirect()->intended(route('bendahara.dashboard')),
            'admin' => redirect()->intended(route('admin.panel')),
            default => redirect()->intended(route('dashboard')),
        };
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout(); // Logout user from web guard

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        // Redirect to the login page or home page after logout
        return redirect('/login'); // Assuming '/login' is your login route
    }

    public function create()
    {
        // This method can be used to show the login form if needed
        return view('auth.login'); // Assuming you have a login view at resources/views/auth/login.blade.php
    }
}
