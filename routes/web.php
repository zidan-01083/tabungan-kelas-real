<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

// Landing Page
Route::view('/', 'landing')->name('landing');

// Auth
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Profile (Authenticated Only)
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Dashboard umum
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Role: Siswa
    Route::middleware('siswa')->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'siswaDashboard'])->name('dashboard');
        Route::post('/setoran', [DepositController::class, 'store'])->name('setoran.store');
        Route::post('/vote', [DashboardController::class, 'vote'])->name('vote');
        Route::get('/anggota', [DashboardController::class, 'lihatAnggotaKelas'])->name('anggota');
        Route::get('/transaksi', [DashboardController::class, 'historyTransaksi'])->name('transaksi');
    });

    // Role: Bendahara
    Route::middleware('bendahara')->prefix('bendahara')->name('bendahara.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'bendaharaDashboard'])->name('dashboard');
        Route::get('/transaksi', [DashboardController::class, 'kelolaTransaksi'])->name('transaksi');
        Route::post('/transaksi/update', [DashboardController::class, 'updateTransaksi'])->name('transaksi.update');
        Route::post('/initiate-vote', [DashboardController::class, 'inisiasiVoting'])->name('vote.initiate');
        Route::get('/anggota', [DashboardController::class, 'kelolaAnggota'])->name('anggota');
        Route::get('/laporan', [DashboardController::class, 'laporanBulanan'])->name('laporan');
    });

    // Role: Guru
    Route::middleware('guru')->prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'guruDashboard'])->name('dashboard');
        Route::get('/anggota', [DashboardController::class, 'lihatSemuaAnggota'])->name('anggota');
        Route::get('/transaksi', [DashboardController::class, 'historyTransaksi'])->name('transaksi');
    });

    // Admin Panel (jika ada peran admin)
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'showAdminPage'])->name('page');
        Route::get('/panel', [AdminController::class, 'index'])->name('panel');
        Route::post('/store-student', [AdminController::class, 'storeStudent'])->name('storeStudent');
        Route::post('/add-student', [AdminController::class, 'storeStudent'])->name('addStudent'); // Duplicate, boleh dihapus salah satu
    });
});
