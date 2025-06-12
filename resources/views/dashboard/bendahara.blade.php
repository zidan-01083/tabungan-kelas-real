@extends('layouts.app')
@section('title', 'Dashboard Bendahara')

@section('content')
    {{-- Display a welcome message for the treasurer. It uses 'nama_siswa' if available, otherwise 'name' from the authenticated user. --}}
    <h2>Halo Bendahara, {{ Auth::user()->nama_siswa ?? Auth::user()->name }}</h2>

    {{-- 1. Transaction History Section --}}
    <h3>Riwayat Transaksi Uang Kas</h3>
    {{-- Include a table component to display transactions. The '$transaksi' variable is passed to it. --}}
    @include('components.transaksi-table', ['transaksi' => $transaksi])

    {{-- 2. Initiate Voting Section --}}
    <h3>Inisiasi Voting Barang</h3>
    {{-- Form to propose a new item for voting. --}}
    <form action="{{ route('bendahara.voting.store') }}" method="POST">
        @csrf {{-- CSRF token for security --}}
        {{-- Input field for the item's name. --}}
        <input type="text" name="nama_barang" placeholder="Nama Barang" class="w-full mb-3 border p-2 rounded" required>
        {{-- Textarea for the item's description. --}}
        <textarea name="deskripsi" placeholder="Deskripsi Barang" class="w-full mb-3 border p-2 rounded" required></textarea>
        {{-- Submit button to propose the item. --}}
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Usulkan</button>
    </form>

    {{-- 3. Manage Class Members Section --}}
    <h3>Kelola Anggota Kelas</h3>
    <ul>
        {{-- Loop through each class member and display their name and an edit link. --}}
        @foreach ($anggotaKelas as $anggota)
            <li class="mb-2 flex items-center justify-between bg-white p-3 rounded shadow">
                {{-- Display the student's name. --}}
                <span class="font-medium">{{ $anggota->nama_siswa ?? $anggota->name }}</span>
                {{-- Link to edit the member's details. The 'id' parameter is now correctly passed. --}}
                <a href="{{ route('bendahara.anggota.edit', ['id' => $anggota->id]) }}" class="text-blue-500 hover:underline">Edit</a>
            </li>
        @endforeach
    </ul>

    {{-- 4. Monthly Report Section --}}
    <h3>Laporan Bulanan</h3>
    {{-- Form to select a month and view the report. --}}
    <form action="{{ route('bendahara.laporan') }}" method="GET" class="bg-white p-6 rounded shadow">
        {{-- Dropdown to select the month. --}}
        <label for="bulan" class="block text-sm font-medium text-gray-700 mb-2">Pilih Bulan:</label>
        <select name="bulan" id="bulan" class="w-full mb-3 border p-2 rounded" required>
            @for($i = 1; $i <= 12; $i++)
                {{-- Options for each month, pre-selecting the current month. --}}
                <option value="{{ $i }}" {{ date('n') == $i ? 'selected' : '' }}>Bulan {{ $i }}</option>
            @endfor
        </select>
        {{-- Submit button to view the report. --}}
        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">Lihat Laporan</button>
    </form>
@endsection
