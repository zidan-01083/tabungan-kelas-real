<?php

namespace App\Models;

class Bendahara extends User
{
    protected static function booted()
    {
        static::addGlobalScope('bendahara', function ($query) {
            $query->where('role', 'bendahara');
        });
    }
}
