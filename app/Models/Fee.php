<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasFactory , HasTranslations;
    public $translatable = ['title'];

    protected $fillable = [
        'title', 'amount', 'grade_id', 'class_id',
        'description', 'year', 'fee_type',
    ];
    public static $rules = [
        'title_ar' => 'required|string',
        'title_en' => 'required|string',
        'amount' => 'required|numeric',
        'grade_id' => 'required|integer|exists:grades,id',
        'description' => 'nullable|string|max:55',
        'year' => 'required|string|max:5',
        'fee_type' => 'nullable|string|max:1',
    ];

    public function grade(){
        return $this->belongsTo(Grade::class);
    }
    public function class(){
        return $this->belongsTo(ClassRoom::class,'class_id');
    }

}
