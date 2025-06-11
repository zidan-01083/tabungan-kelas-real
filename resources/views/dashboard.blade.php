@extends('layouts.app')

@section('content')
<div class="flex">
        <!-- Sidebar -->
        <!-- Sidebar -->
<div class="w-64 bg-blue-900 text-white h-screen">
    <div class="flex items-center justify-center h-16 text-xl font-bold">
        Tabungan Kelas
    </div>
    <ul class="space-y-4 px-4">
        <li>
            <a href="{{ route('dashboard') }}" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('transactions.index') }}" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Riwayat Transaksi</a>
        </li>
        <li>
            <a href="{{ route('students.index') }}" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Anggota Kelas</a>
        </li>
        <li>
        <a href="{{ route('deposits.index') }}" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Setoran Tabungan</a>
        </li>
        <li>
            <a href="{{ route('report.create') }}" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Laporan</a>
        </li>
    </ul>
</div>
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1: Total Tabungan -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-2xl font-semibold mb-4">Total Tabungan</div>
                    <div class="text-3xl font-bold text-green-600"></div>
                </div>

                <!-- Card 2: Anggota Kelas -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-2xl font-semibold mb-4">Anggota Kelas</div>
                    <div class="text-3xl font-bold text-blue-600"></div>
                </div>

                <!-- Card 3: Setoran Terakhir -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-2xl font-semibold mb-4">Setoran Terakhir</div>
                    <div class="text-3xl font-bold text-yellow-600"></div>
                    <div class="text-sm text-gray-600 mt-2">Dari: </div>
                </div>
            </div>

            <!-- Chart / Graph -->
            <div class="bg-white mt-6 p-6 rounded-lg shadow-lg">
                <div class="text-2xl font-semibold mb-4">Grafik Tabungan</div>
                <!-- Di sini bisa menggunakan grafik seperti Chart.js atau lainnya -->
                <div class="bg-gray-300 h-64 rounded-lg">
                    <!-- Grafik akan ditempatkan di sini -->
                </div>
            </div>
        </div>
    </div>

    <!-- Student List Section -->
<div class="bg-white mt-6 p-6 rounded-lg shadow-lg">
    <div class="text-2xl font-semibold mb-4">Daftar Anggota Kelas</div>
    <table class="w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2 text-left">Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td class="px-4 py-2">{{ $student->name }}</td>
                    <td class="px-4 py-2">{{ $student->class_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    @endsection