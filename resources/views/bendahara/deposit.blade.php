@extends('layouts.app')
@section('title', 'Laporan Bulanan')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold mb-6 text-center">Laporan Keuangan Kas Kelas</h1>
    <h2 class="text-xl font-semibold mb-4 text-center">Bulan {{ $namaBulan }} {{ $tahun }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-green-100 p-4 rounded-lg text-center">
            <p class="text-lg font-medium text-green-800">Total Pemasukan:</p>
            <p class="text-2xl font-bold text-green-700">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
        </div>
        <div class="bg-red-100 p-4 rounded-lg text-center">
            <p class="text-lg font-medium text-red-800">Total Pengeluaran:</p>
            <p class="text-2xl font-bold text-red-700">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
        </div>
        <div class="bg-blue-100 p-4 rounded-lg text-center">
            <p class="text-lg font-medium text-blue-800">Saldo Akhir:</p>
            <p class="text-2xl font-bold text-blue-700">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</p>
        </div>
    </div>

    <h3 class="text-2xl font-semibold mb-4">Detail Transaksi</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left border-b">Tanggal</th>
                    <th class="py-3 px-6 text-left border-b">Nama Siswa</th>
                    <th class="py-3 px-6 text-left border-b">Jenis</th>
                    <th class="py-3 px-6 text-right border-b">Jumlah</th>
                    <th class="py-3 px-6 text-left border-b">Keterangan</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse ($transaksiLaporan as $transaksi)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                    <td class="py-3 px-6 text-left">{{ $transaksi->siswa->nama_siswa ?? $transaksi->siswa->name ?? 'N/A' }}</td>
                    <td class="py-3 px-6 text-left">
                        <span class="py-1 px-3 rounded-full text-xs font-semibold
                            @if($transaksi->jenis == 'masuk') bg-green-200 text-green-800
                            @else bg-red-200 text-red-800
                            @endif">
                            {{ ucfirst($transaksi->jenis) }}
                        </span>
                    </td>
                    <td class="py-3 px-6 text-right">Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                    <td class="py-3 px-6 text-left">{{ $transaksi->keterangan }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-3 px-6 text-center">Tidak ada transaksi untuk bulan ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('bendahara.dashboard') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 inline-block">Kembali ke Dashboard</a>
    </div>
</div>
@endsection
