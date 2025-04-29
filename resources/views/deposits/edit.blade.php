@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-xl font-bold mb-4">Edit Setoran</h2>
    <form action="{{ route('deposit.update', $deposit->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <input type="number" name="amount" value="{{ $deposit->amount }}" class="w-full mb-3 border p-2 rounded" required>
        <input type="date" name="date" value="{{ $deposit->date }}" class="w-full mb-3 border p-2 rounded" required>
        <button type="submit" class="bg-blue-600 text-white w-full py-2 rounded">Perbarui</button>
    </form>
</div>
@endsection
