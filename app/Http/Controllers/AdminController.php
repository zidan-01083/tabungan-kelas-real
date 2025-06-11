<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    // Show the admin panel page
    public function index()
    {
        return view('admin.panel');
    }

    // Store a new student in the database
    public function storeStudent(Request $request): RedirectResponse
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_name' => 'required|string|max:255',
        ]);

        // Create a new student record in the database
        Student::create([
            'name' => $validated['name'],
            'class_name' => $validated['class_name'],
        ]);

        // Redirect to the admin panel with a success message
        return redirect()->route('admin.panel')->with('success', 'Anggota kelas berhasil ditambahkan.');
    }
}
