<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    use HasFactory;

    public $fillable = [
        'student_id', 'date','type', 'fee_invoices_id','processing_fees_id','payment_id',
        'receipt_id','debit', 'credit', 'description',
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
    public function receipt(){
        return $this->belongsTo(ReceiptStudent::class);
    }

}
