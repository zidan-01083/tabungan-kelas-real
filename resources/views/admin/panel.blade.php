@extends('layouts.app')

@section('content')
    <h1>Welcome, Admin</h1>
    <h2>Add New Student</h2>

    <!-- Display Success Message if student added -->
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- Add Student Form -->
    <form action="{{ route('admin.addStudent') }}" method="POST">
        @csrf
        <label for="name">Student Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="class_name">Class Name:</label>
        <input type="text" name="class_name" id="class_name" required><br><br>

        <button type="submit">Add Student</button>
    </form>
@endsection
