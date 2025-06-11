<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id',
        'tipe', // masuk atau keluar
        'jumlah',
        'keterangan',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
