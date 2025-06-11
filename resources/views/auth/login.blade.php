@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-20">
    <h2 class="text-xl font-bold mb-4 text-center">Login</h2>

    {{-- Tampilkan error jika login gagal --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <input type="email" name="email" placeholder="Email" class="w-full mb-3 border p-2 rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full mb-3 border p-2 rounded" required>
        <button type="submit" class="bg-lime-500 w-full py-2 text-white rounded hover:bg-lime-600">Masuk</button>
    </form>

    <p class="mt-4 text-center text-sm">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar di sini</a>
    </p>
</div>
@endsection
