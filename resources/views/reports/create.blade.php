@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Buat Laporan</h2>
    <form action="{{ route('report.store') }}" method="POST">
        @csrf
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Generate Laporan</button>
    </form>
</div>
@endsection
