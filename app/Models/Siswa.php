<?php

namespace App\Models;

class Siswa extends User
{
    protected static function booted()
    {
        static::addGlobalScope('siswa', function ($query) {
            $query->where('role', 'siswa');
        });
    }
}
