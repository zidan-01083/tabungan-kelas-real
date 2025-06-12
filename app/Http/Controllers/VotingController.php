<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voting; // Pastikan model Voting sudah ada
use App\Models\Vote;   // Pastikan model Vote sudah ada
use Illuminate\Support\Facades\Auth; // Penting: Import facade Auth
use Illuminate\View\View; // Import View
use Illuminate\Http\RedirectResponse; // Import RedirectResponse

class VotingController extends Controller
{
    /**
     * Menampilkan daftar voting aktif.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Mengambil voting terbaru yang aktif
        $voting = Voting::latest()->first();

        // Memeriksa apakah pengguna sudah melakukan voting pada voting ini
        $sudahVoting = false;
        if (Auth::check() && $voting) {
            $sudahVoting = Vote::where('user_id', Auth::id())
                               ->where('voting_id', $voting->id)
                               ->exists();
        }

        return view('voting.index', compact('voting', 'sudahVoting'));
    }

    /**
     * Menyimpan suara voting dari pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitVote(Request $request): RedirectResponse
    {
        $request->validate([
            'voting_id' => 'required|exists:votings,id',
            'vote' => 'required|in:ya,tidak',
        ]);

        // Mencegah multiple voting dari user yang sama untuk voting yang sama
        if (Auth::check()) {
            $existingVote = Vote::where('user_id', Auth::id())
                                ->where('voting_id', $request->voting_id)
                                ->first();

            if ($existingVote) {
                return back()->with('error', 'Anda sudah memberikan voting untuk barang ini.');
            }
        } else {
             return back()->with('error', 'Anda harus login untuk melakukan voting.');
        }


        Vote::create([
            'user_id' => Auth::id(),
            'voting_id' => $request->voting_id,
            'pilihan' => $request->vote,
        ]);

        // Perbarui jumlah 'ya' atau 'tidak' di model Voting
        $voting = Voting::find($request->voting_id);
        if ($voting) {
            if ($request->vote === 'ya') {
                $voting->increment('jumlah_ya');
            } else {
                $voting->increment('jumlah_tidak');
            }
            $voting->save();
        }


        return back()->with('success', 'Terima kasih telah melakukan voting.');
    }

    /**
     * Menampilkan hasil voting.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showResult(): View|RedirectResponse
    {
        // Mengambil voting terbaru untuk menampilkan hasilnya
        $voting = Voting::latest()->first();

        if (!$voting) {
            return redirect()->route('voting.index')->with('error', 'Tidak ada voting aktif untuk melihat hasilnya.');
        }

        return view('voting.result', compact('voting'));
    }
}
