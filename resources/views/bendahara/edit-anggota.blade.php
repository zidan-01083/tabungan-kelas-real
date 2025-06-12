@extends('layouts.app')
@section('title', 'Edit Anggota')

@section('content')
    <h1>Edit Anggota</h1>
    <form action="{{ route('bendahara.storeAnggota') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $anggota->id }}">
        <input type="text" name="nama_siswa" value="{{ $anggota->nama_siswa }}">
        <input type="text" name="kelas_siswa" value="{{ $anggota->kelas_siswa }}">
        <input type="email" name="email" value="{{ $anggota->email }}">
        <button type="submit">Simpan</button>
    </form>
@endsection
