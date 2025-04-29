@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-20">
    <h2 class="text-xl font-bold mb-4 text-center">Register</h2>
    
    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <input type="text" name="name" placeholder="Nama" class="w-full mb-3 border p-2 rounded" required>
        <input type="email" name="email" placeholder="Email" class="w-full mb-3 border p-2 rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full mb-3 border p-2 rounded" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="w-full mb-3 border p-2 rounded" required>
        <button type="submit" class="bg-sky-500 w-full py-2 text-white rounded hover:bg-sky-600">Daftar</button>
    </form>
</div>
@endsection
