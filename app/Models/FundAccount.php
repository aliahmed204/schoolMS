<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundAccount extends Model
{
    use HasFactory;

    public $fillable = [
        'date', 'receipt_id','payment_id',
        'debit','credit', 'description',
    ];

    public function receipt(){
        return $this->belongsTo(ReceiptStudent::class);
    }
}
