<?php

namespace App\Models;

use App\Http\traits\student\HasRelationshipsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;

class Student extends Authenticatable
{
    use HasFactory ,HasTranslations ,SoftDeletes, HasRelationshipsTrait ;

    public $translatable = ['name'];
    public $perPage = 35;

    const Path = 'attachments/students/';

    protected $fillable = [
        'name', 'email', 'password', 'date_of_birth',
        'academic_year', 'gender_id', 'nationality_id',
        'blood_id', 'grade_id', 'class_id',
        'section_id', 'parent_id',
    ];

    public static $rules = [
        'name_ar' => 'required|min:12|max:55',
        'name_en' => 'required|min:12|max:55',
        'gender_id' => 'required|numeric',
        'nationality_id' => 'required|numeric',
        'blood_id' => 'required|numeric',
        'grade_id' => 'required|numeric',
        'class_id' => 'required|numeric',
        'section_id' => 'required|numeric',
        'parent_id' => 'required|numeric',
        'academic_year' => 'required|string',
        'date_of_birth' => 'required|date|date_format:Y-m-d',
    ];

    public function scopeParentChild(Builder $query): void
    {
        $query->where('parent_id',auth()->user()->id);
    }

    // relation between Student and Images morph
    public function images(){
        return $this->morphMany(Image::class , 'imageable');
    }

    public function studentAccounts(){
        return $this->hasMany(StudentAccount::class);
    }
    public function paymentStudent(){
        return $this->hasMany(PaymentStudent::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

    public function degrees()
    {
        return $this->hasMany(Degree::class, 'student_id');
    }


}
