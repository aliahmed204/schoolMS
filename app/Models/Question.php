<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public $perPage = 35;
    public $fillable = [
        'title','answers','right_answer','score','quiz_id'
    ];

    public function quiz(){
        return $this->belongsTo(Quiz::class , 'quiz_id');
    }

}
