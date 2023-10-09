<?php

namespace App\Interfaces;

use App\Models\Teacher;
use Illuminate\Http\Request;

interface TeacherRepositoryInterface
{
    public function getAllTeachers();
    public function getAllSpecializations();
    public function getAllGenders();
    public function createTeacher($request);
    public function updateTeacher(Teacher $teacher, $request);
    public function deleteTeacher(Teacher $teacher);

}
