<?php

namespace App\Http\traits\student;

use App\Models\ClassRoom;
use App\Models\Genders;
use App\Models\Grade;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\StudentParent;

trait HasRelationshipsTrait
{
    public function gender(){
        return $this->belongsTo(Genders::class);
    }
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
    public function class(){
        return $this->belongsTo(ClassRoom::class);
    }
    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function nationality(){
        return $this->belongsTo(Nationality::class);
    }
    public function parent(){
        return $this->belongsTo(StudentParent::class);
    }
}
