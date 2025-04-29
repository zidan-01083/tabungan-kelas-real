<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'amount', 'date'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
