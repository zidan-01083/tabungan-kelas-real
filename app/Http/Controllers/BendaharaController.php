<?php

namespace App\Http\Controllers;

use App\Models\User; // Import model User
use App\Models\Transaksi; // Import model Transaksi
use App\Models\Voting; // Import model Voting, untuk inisiasi voting
use Illuminate\Http\Request;
use Carbon\Carbon; // Import Carbon untuk manipulasi tanggal
use Illuminate\Support\Facades\Auth; // Penting: Import facade Auth untuk Auth::user()

class BendaharaController extends Controller
{
    /**
     * Menampilkan dashboard bendahara.
     * Mengambil data transaksi dan anggota kelas yang relevan dengan bendahara yang login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user(); // Mengakses user yang sedang login

        // Mengambil transaksi terbaru untuk kelas bendahara yang sedang login
        $transaksi = Transaksi::with('siswa')
            ->whereHas('siswa', fn($q) => $q->where('kelas_siswa', $user->kelas_siswa))
            ->latest()
            ->paginate(10); // Menggunakan paginate untuk pembagian halaman

        // Mendapatkan anggota kelas yang memiliki kelas yang sama dengan bendahara dan memiliki peran 'siswa'
        $anggotaKelas = User::where('kelas_siswa', $user->kelas_siswa)
                            ->where('role', 'siswa')
                            ->get();

        return view('dashboard.bendahara', compact('transaksi', 'anggotaKelas'));
    }

    /**
     * Menampilkan daftar semua anggota kelas (dengan peran 'siswa').
     *
     * @return \Illuminate\View\View
     */
    public function anggotaKelas()
    {
        $anggotaKelas = User::where('role', 'siswa')->get();

        return view('bendahara.anggota-kelas', compact('anggotaKelas'));
    }

    /**
     * Menampilkan form untuk mengedit anggota kelas berdasarkan ID.
     *
     * @param  int  $id ID anggota (User) yang akan diedit
     * @return \Illuminate\View\View
     */
    public function editAnggota($id)
    {
        $anggota = User::findOrFail($id); // Mencari anggota berdasarkan ID atau menghentikan jika tidak ditemukan

        return view('bendahara.edit-anggota', compact('anggota'));
    }

    /**
     * Menyimpan data anggota baru atau memperbarui anggota yang sudah ada.
     * Menggunakan updateOrCreate untuk fleksibilitas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAnggota(Request $request)
    {
        // Validasi data yang masuk dari request
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas_siswa' => 'required|string|max:255',
            // Validasi email unik, kecuali untuk ID user yang sedang diedit
            'email' => 'required|email|unique:users,email,' . $request->id,
        ]);

        // Membuat atau memperbarui data anggota (User)
        $anggota = User::updateOrCreate(
            ['id' => $request->id], // Kriteria pencarian
            $request->only('nama_siswa', 'kelas_siswa', 'email') // Data yang akan diisi/diperbarui
        );

        return redirect()->route('bendahara.anggotaKelas')->with('success', 'Anggota disimpan.');
    }

    /**
     * Menampilkan riwayat transaksi uang kas.
     *
     * @return \Illuminate\View\View
     */
    public function riwayatTransaksi()
    {
        // Mengambil semua transaksi dengan relasi siswa, diurutkan dari yang terbaru
        $transaksi = Transaksi::with('siswa')->latest()->paginate(10);

        return view('bendahara.riwayat-transaksi', compact('transaksi'));
    }

    /**
     * Menampilkan form untuk melakukan setoran kas.
     * Membutuhkan daftar siswa untuk dipilih oleh bendahara.
     *
     * @return \Illuminate\View\View
     */
    public function showDepositForm()
    {
        // Mengambil semua pengguna dengan peran 'siswa' untuk mengisi dropdown
        $students = User::where('role', 'siswa')->get();
        return view('deposits.create', compact('students')); // Mengarahkan ke view 'deposits/create.blade.php'
    }

    /**
     * Menyimpan setoran kas baru yang dilakukan oleh bendahara untuk siswa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeDeposit(Request $request)
    {
        // Validasi data setoran
        $request->validate([
            'student_id' => 'required|exists:users,id', // Memastikan student_id adalah ID user yang valid
            'jumlah' => 'required|numeric|min:100', // Jumlah harus angka dan minimal 100
            'keterangan' => 'nullable|string|max:255', // Keterangan opsional
        ]);

        // Membuat record transaksi baru
        Transaksi::create([
            'user_id' => $request->student_id, // User ID siswa yang melakukan setoran
            'jumlah' => $request->jumlah,
            'jenis' => 'masuk', // Jenis transaksi selalu 'masuk' untuk setoran
            'keterangan' => $request->keterangan ?? 'Setoran uang kas', // Menggunakan keterangan dari input atau default
        ]);

        return redirect()->route('bendahara.deposit')->with('success', 'Setoran berhasil ditambahkan!');
    }

    /**
     * Menginisiasi voting barang (dipanggil dari DashboardController sebelumnya, sekarang di sini untuk konsistensi jika diinginkan).
     * Jika BendaharaController yang akan memegang inisiasi voting.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function inisiasiVoting(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Voting::create([
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'jumlah_ya' => 0, // Inisialisasi jumlah 'ya'
            'jumlah_tidak' => 0, // Inisialisasi jumlah 'tidak'
        ]);

        return back()->with('success', 'Voting berhasil dibuat.');
    }

    /**
     * Menggenerate laporan bulanan berdasarkan bulan yang dipilih.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function generateLaporan(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = date('Y'); // Asumsi tahun saat ini

        $user = Auth::user(); // Mengakses user yang sedang login

        // Mengambil transaksi berdasarkan bulan dan tahun yang dipilih, serta kelas bendahara yang login
        $transaksiLaporan = Transaksi::with('siswa')
            ->whereHas('siswa', fn($q) => $q->where('kelas_siswa', $user->kelas_siswa))
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->latest()
            ->get();

        // Menghitung total pemasukan dan pengeluaran
        $totalPemasukan = $transaksiLaporan->where('jenis', 'masuk')->sum('jumlah');
        $totalPengeluaran = $transaksiLaporan->where('jenis', 'keluar')->sum('jumlah');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        // Mendapatkan nama bulan dalam bahasa Indonesia
        $namaBulan = Carbon::create()->month($bulan)->locale('id')->monthName;

        return view('reports.monthly', compact('transaksiLaporan', 'totalPemasukan', 'totalPengeluaran', 'saldoAkhir', 'namaBulan', 'tahun'));
    }
}
