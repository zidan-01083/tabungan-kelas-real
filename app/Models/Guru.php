<?php

namespace App\Models;

class Guru extends User
{
    protected static function booted()
    {
        static::addGlobalScope('guru', function ($query) {
            $query->where('role', 'guru');
        });
    }
}
