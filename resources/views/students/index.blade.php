@if($student->deposits->count())
    <table class="w-full mt-2 text-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Tanggal</th>
                <th class="p-2">Jumlah</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student->deposits as $deposit)
                <tr class="border-b">
                    <td class="p-2">{{ $deposit->date }}</td>
                    <td class="p-2">Rp {{ number_format($deposit->amount, 0, ',', '.') }}</td>
                    <td class="p-2">
                        <a href="{{ route('deposit.edit', $deposit->id) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('deposit.destroy', $deposit->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus setoran ini?')" class="text-red-600 ml-2">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
