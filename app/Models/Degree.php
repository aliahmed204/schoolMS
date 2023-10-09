<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;

    protected $fillable = [
      'quiz_id','question_id','student_id','score','answer','abuse','date'
    ];
    protected $perPage = 25;

    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function quiz(){
        return $this->belongsTo(Quiz::class , 'quiz_id');
    }
    public function question(){
        return $this->belongsTo(Question::class);
    }
}
