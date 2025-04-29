@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-xl font-bold mb-4">Setor Tabungan: {{ $student->name }}</h2>
    <form action="{{ route('deposit.store', $student->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <input type="number" name="amount" placeholder="Jumlah Setoran" class="w-full mb-3 border p-2 rounded" required>
        <input type="date" name="date" class="w-full mb-3 border p-2 rounded" required>
        <button type="submit" class="bg-sky-500 text-white w-full py-2 rounded">Simpan</button>
    </form>
</div>
@endsection