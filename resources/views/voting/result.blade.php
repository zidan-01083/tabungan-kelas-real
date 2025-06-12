@extends('layouts.app')
@section('title', 'Hasil Voting')

@section('content')
    <h1>Hasil Voting</h1>

    <p>Barang: {{ $voting->nama_barang }}</p>
    <p>Ya: {{ $voting->jumlah_ya }}</p>
    <p>Tidak: {{ $voting->jumlah_tidak }}</p>
@endsection
    