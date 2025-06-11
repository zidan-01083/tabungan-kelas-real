<?php
namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Student;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    // Menampilkan daftar setoran tabungan
    public function index()
    {
        $deposits = Deposit::with('student')->get(); // Ambil data setoran dengan relasi siswa
        return view('deposits.index', compact('deposits'));
    }

    // Menampilkan form untuk menambah setoran
    public function create()
    {
        $students = Student::all(); // Ambil data siswa untuk dipilih
        return view('deposits.create', compact('students'));
    }

    // Menyimpan setoran baru
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric',
            'deposit_time' => 'required|date',
        ]);

        Deposit::create($request->all());
        return redirect()->route('deposits.index')->with('success', 'Setoran berhasil ditambahkan!');
    }

    // Menampilkan form edit setoran
    public function edit(Deposit $deposit)
    {
        $students = Student::all();
        return view('deposits.edit', compact('deposit', 'students'));
    }

    // Memperbarui setoran yang sudah ada
    public function update(Request $request, Deposit $deposit)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric',
            'deposit_time' => 'required|date',
        ]);

        $deposit->update($request->all());
        return redirect()->route('deposits.index')->with('success', 'Setoran berhasil diperbarui!');
    }

    // Menghapus setoran
    public function destroy(Deposit $deposit)
    {
        $deposit->delete();
        return redirect()->route('deposits.index')->with('success', 'Setoran berhasil dihapus!');
    }
}
