@extends('layouts.app')
@section('title', 'Dashboard Bendahara')

@section('content')
    <h2>Halo Bendahara, {{ Auth::user()->nama_siswa }}</h2>

    {{-- 1. History Transaksi --}}
    <h3>Riwayat Transaksi Uang Kas</h3>
    @include('components.transaksi-table', ['transaksi' => $transaksi])

    {{-- 2. Inisiasi Voting --}}
    <h3>Inisiasi Voting Barang</h3>
    <form action="{{ route('bendahara.voting.store') }}" method="POST">
        @csrf
        <input type="text" name="nama_barang" placeholder="Nama Barang">
        <textarea name="deskripsi" placeholder="Deskripsi Barang"></textarea>
        <button type="submit">Usulkan</button>
    </form>

    {{-- 3. Edit Anggota --}}
    <h3>Kelola Anggota Kelas</h3>
    <ul>
        @foreach ($anggotaKelas as $anggota)
            <li>
                {{ $anggota->nama_siswa }}
                <a href="{{ route('bendahara.anggota.edit', $anggota->id) }}">Edit</a>
            </li>
        @endforeach
    </ul>

    {{-- 4. Laporan Transaksi Bulanan --}}
    <h3>Laporan Bulanan</h3>
    <form action="{{ route('bendahara.laporan') }}" method="GET">
        <select name="bulan">
            @for($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}">Bulan {{ $i }}</option>
            @endfor
        </select>
        <button type="submit">Lihat Laporan</button>
    </form>
@endsection
