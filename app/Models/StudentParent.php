<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class StudentParent extends Authenticatable
{
    use HasFactory , HasTranslations;
    public $translatable = [
        'Father_Name',
        'Father_job',
        'Mother_Name',
        'Mother_Job',

    ];

    protected $guarded = [];
}
