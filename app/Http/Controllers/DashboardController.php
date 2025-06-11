<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all students to pass to the view
        $students = Student::all(); // Adjust query if needed (e.g. paginate)
        
        // Pass the students to the dashboard view
        return view('dashboard', compact('students'));
    }
}
