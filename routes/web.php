<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Login/Register manual (simple demo)
Route::view('/', 'auth.login')->name('login');

// Register routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Anggota Kelas
Route::get('/students', [StudentController::class, 'index'])->name('students.index');

// Setoran Tabungan
Route::get('/students/{id}/deposit', [DepositController::class, 'create'])->name('deposit.create');
Route::post('/students/{id}/deposit', [DepositController::class, 'store'])->name('deposit.store');
