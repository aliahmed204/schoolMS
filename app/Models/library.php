<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class library extends Model
{
    use HasFactory;
    protected $table = 'library';
    public $fillable = ['title','file_name','grade_id','class_id','section_id','teacher_id'];
    const Path = 'attachments/library/';
    protected $perPage = 2;
    public static $rules = [
        'title'      => 'required|string|max:60',
        'teacher_id' => 'required|exists:teachers,id',
        'grade_id'   => 'required|exists:grades,id',
        'class_id'   => 'required|exists:class_rooms,id',
        'section_id' => 'required|exists:sections,id',
    ];
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
