@extends('layouts.app')
@section('title', 'Dashboard Siswa')

@section('content')
    <h1>Dashboard Siswa</h1>
    <p>Selamat datang, {{ Auth::user()->nama_siswa }}</p>
@endsection
