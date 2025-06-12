@extends('layouts.app')
@section('title', 'Voting Barang')

@section('content')
    <h1>Voting Barang</h1>

    @if ($voting)
        <p><strong>Barang:</strong> {{ $voting->nama_barang }}</p>
        <p><strong>Deskripsi:</strong> {{ $voting->deskripsi }}</p>

        <form action="{{ route('voting.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="voting_id" value="{{ $voting->id }}">
            <label><input type="radio" name="vote" value="ya"> Ya</label>
            <label><input type="radio" name="vote" value="tidak"> Tidak</label>
            <button type="submit">Submit Vote</button>
        </form>
    @else
        <p>Tidak ada voting aktif.</p>
    @endif
@endsection
