<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id','grade_id','class_id','section_id','teacher_id','for_day','status'
    ];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function class()
    {
        return $this->belongsTo(ClassRoom::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
