<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory , HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name', 'email', 'password', 'joining_date',
        'address', 'gender_id', 'specialization_id'
    ];



    public function gender(){
        return $this->belongsTo(Genders::class);
    }
    public function specialization(){
        return $this->belongsTo(Specialization::class);
    }

    public function sections(){
        return $this->belongsToMany(Section::class , 'section_teacher');
    }
}
