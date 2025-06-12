<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\User; // Penting: Pastikan baris ini ada untuk mengimpor model User
use App\Models\Voting;
use App\Models\Vote;
use Illuminate\Support\Facades\Hash; // Penting: untuk hash password
use Illuminate\Database\Eloquent\Model; // Tambahkan ini untuk hinting Model

class SiswaController extends Controller
{
    /**
     * Menampilkan dashboard khusus untuk siswa.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /** @var \App\Models\User $user */ // Tambahkan ini untuk hinting tipe $user
        $user = Auth::user();

        // Mengambil transaksi hanya untuk kelas siswa yang login
        $transaksi = Transaksi::with('siswa')
            ->whereHas('siswa', fn($q) => $q->where('kelas_siswa', $user->kelas_siswa))
            ->latest()
            ->paginate(10);

        // Mengambil voting terbaru
        $voting = Voting::latest()->first();
        $sudahVoting = false;
        if ($voting) {
            $sudahVoting = Vote::where('user_id', $user->id)
                ->where('voting_id', $voting->id)
                ->exists();
        }

        // Mengambil anggota kelas yang sama
        $anggotaKelas = User::where('kelas_siswa', $user->kelas_siswa)
            ->where('id', '!=', $user->id)
            ->get();

        return view('dashboard.siswa', compact('transaksi', 'voting', 'sudahVoting', 'anggotaKelas'));
    }

    /**
     * Memperbarui profil siswa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas_siswa' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        /** @var \App\Models\User $user */ // Tambahkan ini untuk hinting tipe $user
        $user = Auth::user(); // Dapatkan user yang sedang login

        $data = $request->only(['nama_siswa', 'kelas_siswa', 'email']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Metode update() pada model Eloquent User
        $user->update($data);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Menyimpan setoran uang kas dari siswa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Menyimpan suara voting siswa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $voting_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function vote(Request $request, $voting_id)
    {
        $request->validate(['vote' => 'required|in:ya,tidak']);

        // Cek apakah sudah voting untuk voting_id ini
        if (Vote::where('user_id', Auth::id())->where('voting_id', $voting_id)->exists()) {
            return back()->with('error', 'Anda sudah memberikan voting untuk barang ini.');
        }

        Vote::create([
            'user_id' => Auth::id(),
            'voting_id' => $voting_id,
            'pilihan' => $request->vote,
        ]);

        // Perbarui jumlah voting di model Voting
        $voting = Voting::find($voting_id);
        if ($voting) {
            if ($request->vote === 'ya') {
                $voting->increment('jumlah_ya');
            } else {
                $voting->increment('jumlah_tidak');
            }
        }

        return back()->with('success', 'Terima kasih telah melakukan voting.');
    }
}
