<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Voting;
use App\Models\Vote;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $transaksi = Transaksi::with('siswa')
            ->whereHas('siswa', fn($q) => $q->where('kelas_siswa', $user->kelas_siswa))
            ->latest()
            ->paginate(10);

        $anggotaKelas = User::where('kelas_siswa', $user->kelas_siswa)
            ->where('id', '!=', $user->id)
            ->get();

        if ($user->role === 'siswa') {
            $voting = Voting::latest()->first();
            $sudahVoting = Vote::where('user_id', $user->id)
                ->where('voting_id', optional($voting)->id)
                ->exists();

            return view('dashboard.siswa', compact('transaksi', 'voting', 'sudahVoting', 'anggotaKelas'));
        }

        if ($user->role === 'bendahara') {
            return view('dashboard.bendahara', compact('transaksi', 'anggotaKelas'));
        }

        if ($user->role === 'guru') {
            return view('dashboard.guru', compact('transaksi', 'anggotaKelas'));
        }

        abort(403);
    }

    public function updateProfile(Request $request)
{
    $request->validate([
        'nama_siswa' => 'required|string|max:255',
        'kelas_siswa' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $user = User::find(Auth::id()); // ✅ lebih aman untuk intelephense

    $data = $request->only(['nama_siswa', 'kelas_siswa', 'email']);
    
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $user->update($data);

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}


    public function setor(Request $request)
    {
        $request->validate(['jumlah' => 'required|numeric|min:100']);
        Transaksi::create([
            'user_id' => Auth::id(),
            'jumlah' => $request->jumlah,
            'jenis' => 'masuk',
            'keterangan' => 'Setoran dari siswa',
        ]);

        return back()->with('success', 'Setoran berhasil ditambahkan.');
    }

    public function vote(Request $request, $voting_id)
    {
        $request->validate(['vote' => 'required|in:ya,tidak']);

        Vote::create([
            'user_id' => Auth::id(),
            'voting_id' => $voting_id,
            'pilihan' => $request->vote,
        ]);

        return back()->with('success', 'Terima kasih telah melakukan voting.');
    }

    public function inisiasiVoting(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Voting::create($request->only('nama_barang', 'deskripsi'));
        return back()->with('success', 'Voting berhasil dibuat.');
    }
}
