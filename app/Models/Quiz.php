<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quiz extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name','subject_id','teacher_id','grade_id',
        'class_id','section_id',
    ];
    protected $perPage = 35;

    public function scopeTeacherQuiz(Builder $query){
        $query->where('teacher_id' , auth()->user()->id);
    }

    public function degree(){
        return $this->hasMany(Degree::class);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function class(){
        return $this->belongsTo(ClassRoom::class);
    }
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
    public function section(){
        return $this->belongsTo(Section::class);
    }

}
