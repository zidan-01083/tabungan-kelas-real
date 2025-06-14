<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    // Pastikan nama tabel benar
    protected $table = 'students';

    // Isi kolom yang bisa diisi
    protected $fillable = ['name', 'class_name'];

    // Relasi dengan model Deposit
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
