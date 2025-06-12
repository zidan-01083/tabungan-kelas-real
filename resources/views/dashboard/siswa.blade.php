@extends('layouts.app')
@section('title', 'Dashboard Siswa')

@section('content')
    <h2>Halo, {{ Auth::user()->nama_siswa }}</h2>

    {{-- 1. History Transaksi --}}
    <h3>Riwayat Transaksi Kelas</h3>
    @include('components.transaksi-table', ['transaksi' => $transaksi])

    {{-- 2. Edit Profile --}}
    <h3>Edit Profil</h3>
    <form action="{{ route('siswa.profile.update') }}" method="POST">
        @csrf @method('PUT')
        <input type="text" name="nama_siswa" value="{{ old('nama_siswa', Auth::user()->nama_siswa) }}" placeholder="Nama">
        <input type="text" name="kelas_siswa" value="{{ old('kelas_siswa', Auth::user()->kelas_siswa) }}" placeholder="Kelas">
        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="Email">
        <input type="password" name="password" placeholder="Password (biarkan kosong jika tidak diubah)">
        <button type="submit">Simpan</button>
    </form>

    {{-- 3. Setoran --}}
    <h3>Setor Uang Kas</h3>
    <form action="{{ route('siswa.setor') }}" method="POST">
        @csrf
        <input type="number" name="jumlah" placeholder="Jumlah Setoran">
        <button type="submit">Setor</button>
    </form>

    {{-- 4. Voting --}}
    <h3>Voting Barang</h3>
    @if($voting)
        <p>{{ $voting->nama_barang }} - {{ $voting->deskripsi }}</p>
        @if(!$sudahVoting)
            <form action="{{ route('siswa.vote', $voting->id) }}" method="POST">
                @csrf
                <button name="vote" value="ya" type="submit">Ya</button>
                <button name="vote" value="tidak" type="submit">Tidak</button>
            </form>
        @else
            <p>✅ Anda sudah memberikan voting</p>
        @endif
    @else
        <p>Tidak ada voting aktif saat ini.</p>
    @endif

    {{-- 5. Daftar Anggota --}}
    <h3>Anggota Kelas {{ Auth::user()->kelas_siswa }}</h3>
    <ul>
        @foreach ($anggotaKelas as $anggota)
            <li>{{ $anggota->nama_siswa }}</li>
        @endforeach
    </ul>
@endsection
