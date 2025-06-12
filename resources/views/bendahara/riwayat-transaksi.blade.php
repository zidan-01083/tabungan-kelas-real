@extends('layouts.app')
@section('title', 'Riwayat Transaksi')

@section('content')
    <h1>Riwayat Transaksi Uang Kas</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Jenis</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $t)
                <tr>
                    <td>{{ $t->siswa->nama_siswa ?? 'Tidak diketahui' }}</td>
                    <td>{{ $t->jumlah }}</td>
                    <td>{{ $t->tipe }}</td>
                    <td>{{ $t->tanggal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
