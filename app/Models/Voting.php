<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'kelas_id',
        'dibuat_oleh', // id user (bendahara)
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
