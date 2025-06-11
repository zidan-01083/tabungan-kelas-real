@extends('layouts.app')
@section('title', 'Dashboard Guru')

@section('content')
    <h2>Halo, Bapak/Ibu {{ Auth::user()->name }}</h2>

    {{-- 1. Daftar Anggota Kelas --}}
    <h3>Anggota Kelas</h3>
    <ul>
        @foreach ($anggotaKelas as $anggota)
            <li>{{ $anggota->nama_siswa }} ({{ $anggota->role }})</li>
        @endforeach
    </ul>

    {{-- 2. History Transaksi --}}
    <h3>Riwayat Transaksi Uang Kas</h3>
    @include('components.transaksi-table', ['transaksi' => $transaksi])
@endsection
