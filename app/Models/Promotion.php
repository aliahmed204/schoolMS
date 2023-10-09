<?php

namespace App\Models;

use App\Http\traits\promotion\HasTransferRelationshipsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory ,HasTransferRelationshipsTrait;

    public $fillable = [
        'student_id',
        'from_grade', 'from_class', 'from_section',
        'to_grade', 'to_class', 'to_section',
        'from_academic_year', 'to_academic_year',
    ];
}
