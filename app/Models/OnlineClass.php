<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineClass extends Model
{
    use HasFactory;

    public $fillable = [
        'grade_id', 'class_id', 'section_id', 'created_by',
        'meeting_id', 'topic' , 'start_at' , 'duration',
        'password', 'start_url', 'join_url'
    ];

    protected $perPage = 8;

    public function scopeCreatedBy(Builder $query){
        $query->where('created_by' , auth()->user()->email );
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
