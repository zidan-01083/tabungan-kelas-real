<?php
namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function create($id)
    {
        $student = Student::findOrFail($id);
        return view('deposits.create', compact('student'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'date' => 'required|date'
        ]);

        Deposit::create([
            'student_id' => $id,
            'amount' => $request->amount,
            'date' => $request->date
        ]);

        return redirect()->route('students.index')->with('success', 'Setoran berhasil ditambahkan.');
    }

    public function edit($id)
{
    $deposit = Deposit::findOrFail($id);
    return view('deposits.edit', compact('deposit'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'amount' => 'required|numeric|min:1000',
        'date' => 'required|date'
    ]);

    $deposit = Deposit::findOrFail($id);
    $deposit->update($request->only('amount', 'date'));

    return redirect()->route('students.index')->with('success', 'Setoran berhasil diperbarui.');
}

public function destroy($id)
{
    $deposit = Deposit::findOrFail($id);
    $deposit->delete();

    return redirect()->route('students.index')->with('success', 'Setoran berhasil dihapus.');
}

}
