<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relasi one-to-one ke Student
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    // Helper role check
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isGuru()
    {
        return $this->role === 'guru';
    }

    public function isBendahara()
    {
        return $this->role === 'bendahara';
    }

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }
}

