@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-20">
    <h2 class="text-xl font-bold mb-4 text-center">Login</h2>
    <form action="/dashboard" method="GET" class="bg-white p-6 rounded shadow">
        <input type="text" name="email" placeholder="Email" class="w-full mb-3 border p-2 rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full mb-3 border p-2 rounded" required>
        <button type="submit" class="bg-lime-500 w-full py-2 text-white rounded">Masuk</button>
    </form>
</div>
@endsection
