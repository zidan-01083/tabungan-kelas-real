<?php

use App\Models\Voting;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VotingController; // Penting: Tambahkan ini
use Carbon\Carbon;
use App\Kernel;

// Landing Page
Route::view('/', 'landing')->name('landing');

// Authentication Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Authenticated Routes
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Default Dashboard Redirector
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ===================== Siswa =====================
    Route::middleware(['auth', 'siswa'])->group(function () {
        Route::get('/siswa/dashboard', [DashboardController::class, 'index'])->name('siswa.dashboard');
        Route::put('/siswa/profile/update', [DashboardController::class, 'updateProfile'])->name('siswa.profile.update');
        Route::post('/siswa/setor', [DashboardController::class, 'setor'])->name('siswa.setor');
        Route::post('/siswa/vote/{voting_id}', [DashboardController::class, 'vote'])->name('siswa.vote');
    });

    // ===================== Guru =====================
    Route::middleware(['auth', 'guru'])->group(function () {
        Route::get('/guru/dashboard', [DashboardController::class, 'index'])->name('guru.dashboard');
    });

    // ===================== Bendahara =====================
    Route::middleware(['auth', 'bendahara'])->group(function () {
        Route::get('/bendahara/dashboard', [BendaharaController::class, 'index'])->name('bendahara.dashboard');
        Route::get('/bendahara/anggota-kelas', [BendaharaController::class, 'anggotaKelas'])->name('bendahara.anggotaKelas');
        Route::get('/bendahara/anggota-kelas/{id}/edit', [BendaharaController::class, 'editAnggota'])->name('bendahara.anggota.edit');
        Route::post('/bendahara/store-anggota', [BendaharaController::class, 'storeAnggota'])->name('bendahara.storeAnggota');
        Route::get('/bendahara/riwayat-transaksi', [BendaharaController::class, 'riwayatTransaksi'])->name('bendahara.riwayatTransaksi');
        Route::post('/bendahara/voting/store', [DashboardController::class, 'inisiasiVoting'])->name('bendahara.voting.store');
        Route::get('/bendahara/laporan', [BendaharaController::class, 'generateLaporan'])->name('bendahara.laporan');
        Route::get('/bendahara/deposit', [BendaharaController::class, 'showDepositForm'])->name('bendahara.deposit');
        Route::post('/bendahara/deposit', [BendaharaController::class, 'storeDeposit'])->name('bendahara.storeDeposit');
    });

    // ===================== Admin Panel =====================
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('panel');
        Route::post('/store-student', [AdminController::class, 'storeStudent'])->name('storeStudent');
        Route::get('/deposits', [DepositController::class, 'index'])->name('deposits.index');
        Route::get('/deposits/create', [DepositController::class, 'create'])->name('deposits.create');
        Route::post('/deposits', [DepositController::class, 'store'])->name('deposits.store');
        Route::get('/deposits/{deposit}/edit', [DepositController::class, 'edit'])->name('deposits.edit');
        Route::put('/deposits/{deposit}', [DepositController::class, 'update'])->name('deposits.update');
        Route::delete('/deposits/{deposit}', [DepositController::class, 'destroy'])->name('deposits.destroy');
        Route::get('/students', [\App\Http\Controllers\StudentController::class, 'index'])->name('students.index');
        Route::get('/transactions/history', [\App\Http\Controllers\TransactionController::class, 'showhistory'])->name('transactions.index');
        Route::get('/reports/create', [ReportController::class, 'create'])->name('report.create');
        Route::post('/reports/store', [ReportController::class, 'store'])->name('report.store');
    });

    // ===================== Voting (Global jika siswa, guru, bendahara bisa lihat) =====================
    Route::get('/voting', [VotingController::class, 'index'])->name('voting.index');
    Route::post('/voting/submit', [VotingController::class, 'submitVote'])->name('voting.submit');
    Route::get('/voting/result', [VotingController::class, 'showResult'])->name('voting.result');

});

// Rute untuk autentikasi yang sudah ada dari Laravel Breeze/UI
require __DIR__.'/auth.php';
