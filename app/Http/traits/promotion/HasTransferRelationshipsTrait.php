<?php

namespace App\Http\traits\promotion;

use App\Models\ClassRoom;
use App\Models\Genders;
use App\Models\Grade;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentParent;

trait HasTransferRelationshipsTrait
{
    public function student(){
        return $this->belongsTo(Student::class );
    }
    public function fromGrade()
    {
        return $this->belongsTo(Grade::class, 'from_grade');
    }

    public function fromClass()
    {
        return $this->belongsTo(ClassRoom::class, 'from_class');
    }

    public function fromSection()
    {
        return $this->belongsTo(Section::class, 'from_section');
    }

    public function toGrade()
    {
        return $this->belongsTo(Grade::class, 'to_grade');
    }

    public function toClass()
    {
        return $this->belongsTo(ClassRoom::class, 'to_class');
    }

    public function toSection()
    {
        return $this->belongsTo(Section::class, 'to_section');
    }
}
