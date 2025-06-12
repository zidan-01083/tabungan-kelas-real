<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\User;

class GuruController extends Controller
{
    /**
     * Menampilkan dashboard khusus untuk guru.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        // Mengambil transaksi hanya untuk kelas yang diajar guru (asumsi guru punya kelas_siswa)
        // Jika guru tidak punya kelas_siswa, Anda perlu menyesuaikan logika ini.
        $transaksi = Transaksi::with('siswa')
            ->whereHas('siswa', fn($q) => $q->where('kelas_siswa', $user->kelas_siswa))
            ->latest()
            ->paginate(10);

        // Mengambil semua anggota kelas yang sama dengan kelas guru
        $anggotaKelas = User::where('kelas_siswa', $user->kelas_siswa)
            ->where('role', 'siswa') // Hanya tampilkan siswa
            ->get();

        return view('dashboard.guru', compact('transaksi', 'anggotaKelas'));
    }
}
