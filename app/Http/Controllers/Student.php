<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Menampilkan semua data siswa dan mengirim ke view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua user dengan role 'siswa'
        $students = User::where('role', 'siswa')->get();

        // Kirim data ke view 'students.index'
        return view('students.index', compact('students'));
    }
}
