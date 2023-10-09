<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeInvoice extends Model
{
    use HasFactory;
    public $fillable = [
        'invoice_date','amount', 'description',
        'student_id', 'grade_id', 'class_id', 'fee_id'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
    public function class(){
        return $this->belongsTo(ClassRoom::class);
    }
    public function fee(){
        return $this->belongsTo(Fee::class);
    }
}
