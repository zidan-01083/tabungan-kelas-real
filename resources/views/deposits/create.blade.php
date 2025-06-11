@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Tambah Setoran</h2>

    <form action="{{ route('deposits.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <label for="student_id" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
        <select name="student_id" id="student_id" class="w-full mb-3 border p-2 rounded" required>
            <option value="">Pilih Siswa</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
            @endforeach
        </select>

        <label for="amount" class="block text-sm font-medium text-gray-700">Nominal</label>
        <input type="number" name="amount" id="amount" class="w-full mb-3 border p-2 rounded" required>

        <label for="deposit_time" class="block text-sm font-medium text-gray-700">Waktu Setoran</label>
        <input type="datetime-local" name="deposit_time" id="deposit_time" class="w-full mb-3 border p-2 rounded" required>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Simpan Setoran</button>
    </form>
</div>
@endsection
