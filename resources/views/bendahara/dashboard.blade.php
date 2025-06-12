@extends('layouts.app')
@section('title', 'Dashboard Bendahara')

@section('content')
    <h1>Dashboard Bendahara</h1>
    <a href="{{ route('bendahara.deposit') }}">Setoran Kas</a>
    <a href="{{ route('bendahara.anggotaKelas') }}">Anggota Kelas</a>
    <a href="{{ route('voting.index') }}">Voting Barang</a>
    <a href="{{ route('bendahara.anggota.edit', $anggota->id) }}">Edit</a>
@endsection
