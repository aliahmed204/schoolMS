<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory , HasTranslations;
    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'grade_id',
        'class_id',
        'status',
    ];
    public function class(){
        return $this->belongsTo(ClassRoom::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }
}
