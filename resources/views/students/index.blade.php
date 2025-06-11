@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Daftar Anggota Kelas</h2>
    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-3">Nama</th>
                <th class="p-3">Email</th>
                <th class="p-3">Role</th>
                <th class="p-3">Class</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr class="border-b">
                    <td class="p-3">{{ $student->name }}</td>
                    <td class="p-3">{{ $student->email }}</td>
                    <td class="p-3 capitalize">{{ $student->role }}</td>
                    <td class="p-3 capitalize">{{ $student->class_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
