<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nama_siswa',
        'kelas_siswa',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
