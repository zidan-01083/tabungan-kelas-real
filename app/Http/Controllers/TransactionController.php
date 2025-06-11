<?php
namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Student;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function showhistory()
    {
        $deposits = Deposit::with('student')->get(); // Ambil data setoran dengan relasi siswa
        return view('transactions.index', compact('deposits'));
    }
}
