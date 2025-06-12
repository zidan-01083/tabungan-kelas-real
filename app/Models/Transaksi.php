<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Transaksi extends Model
{
    protected $table = 'transaksi'; // ✅ pastikan nama tabel sesuai dengan database

    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'kelas_siswa', // tambahkan ini
];


    /**
     * Relasi: Transaksi dimiliki oleh satu siswa (user)
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
