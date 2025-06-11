@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Riwayat Setoran</h2>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Nama Siswa</th>
                <th class="px-4 py-2 border">Nominal</th>
                <th class="px-4 py-2 border">Waktu Setoran</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deposits as $deposit)
                <tr>
                    <td class="px-4 py-2 border">{{ $deposit->student->name }}</td>
                    <td class="px-4 py-2 border">Rp {{ number_format($deposit->amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border">{{ $deposit->deposit_time }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('deposits.edit', $deposit) }}" class="text-yellow-600">Edit</a>
                        <form action="{{ route('deposits.destroy', $deposit) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

