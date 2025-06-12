<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi; // Tetap import jika masih ada logika umum yang memerlukannya
use App\Models\User;     // Tetap import jika masih ada logika umum yang memerlukannya
use App\Models\Voting;   // Tetap import jika masih ada logika umum yang memerlukannya
use App\Models\Vote;     // Tetap import jika masih ada logika umum yang memerlukannya
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Mengarahkan pengguna ke dashboard yang sesuai berdasarkan peran mereka.
     * Ini akan menjadi titik masuk utama setelah login.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        return match ($user->role) {
            'siswa' => redirect()->intended(route('siswa.dashboard')),
            'guru' => redirect()->intended(route('guru.dashboard')),
            'bendahara' => redirect()->intended(route('bendahara.dashboard')),
            'admin' => redirect()->intended(route('admin.panel')),
            default => view('dashboard.default'), // Fallback view jika peran tidak dikenali
        };
    }

    // Metode-metode seperti updateProfile, setor, vote, inisiasiVoting akan dihapus
    // dari sini dan dipindahkan ke controller peran masing-masing (SiswaController, BendaharaController)
    // Jika ada fungsi umum yang perlu diakses oleh semua peran, bisa tetap di sini atau dipindahkan ke Controller dasar.

    // Contoh: Jika ada metode updateProfile yang bersifat umum untuk semua user tanpa melihat peran
    // public function updateProfile(Request $request) { ... }
}
