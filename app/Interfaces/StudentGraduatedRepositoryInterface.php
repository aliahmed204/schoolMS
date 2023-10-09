<?php

namespace App\Interfaces;


use App\Models\Student;
use Illuminate\Http\Request;

interface StudentGraduatedRepositoryInterface
{

    public function getGraduatedStudents();
    public function create();
    public function softDelete(Request $request);
    public function studentSoftDeleteById(Student $student);
    public function forceDelete(int $id);
    public function restore(int $id);
}

