<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Student;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\DashboardController;
    
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// Landing Page
Route::view('/', 'landing')->name('landing');

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Anggota Kelas
Route::get('/students', [StudentController::class, 'index'])->name('students.index');

// Setoran Tabungan
Route::resource('deposits', DepositController::class)->middleware('auth');  

// Riwayat Transaksi
Route::get('transactions', [TransactionController::class, 'showhistory'])->name('transactions.index');
// Form Laporan
Route::get('/report', [ReportController::class, 'create'])->name('report.create');
Route::post('/report', [ReportController::class, 'store'])->name('report.store');

Route::get('/admin/panel', [AdminController::class, 'index'])->name('admin.panel');
Route::post('/admin/store-student', [AdminController::class, 'storeStudent'])->name('admin.storeStudent');
Route::post('/admin/add-student', [AdminController::class, 'storeStudent'])->name('admin.addStudent');
Route::get('/admin', [AdminController::class, 'showAdminPage'])->name('admin.page');

