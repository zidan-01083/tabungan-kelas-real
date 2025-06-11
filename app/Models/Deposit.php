<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'amount', 'deposit_time'];

    // Relasi ke model Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
