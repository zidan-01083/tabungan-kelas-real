@extends('layouts.app')
@section('title', 'Anggota Kelas')

@section('content')
    <h1>Daftar Anggota Kelas</h1>
    <ul>
        @foreach ($anggotaKelas as $anggota)
    <tr>
        <td>{{ $anggota->nama_siswa }}</td>
        <td>
            <a href="{{ route('bendahara.anggota.edit', $anggota->id) }}" class="text-blue-500">Edit</a>
            <a href="{{ route('bendahara.anggota.edit', $anggota->id) }}">Edit</a>

        </td>
    </tr>
        @endforeach

    </ul>
@endsection
