<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Jenis</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksi as $t)
            <tr>
                <td>{{ $t->created_at->format('d-m-Y') }}</td>
                <td>{{ $t->siswa->nama_siswa }}</td>
                <td>Rp{{ number_format($t->jumlah, 0, ',', '.') }}</td>
                <td>{{ ucfirst($t->jenis) }}</td>
                <td>{{ $t->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $transaksi->links() }}
