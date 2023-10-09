<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessingFee extends Model
{
    use HasFactory;

    public $fillable = [
        'date', 'student_id',
        'amount', 'description',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
