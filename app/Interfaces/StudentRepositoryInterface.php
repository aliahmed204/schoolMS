<?php

namespace App\Interfaces;

use App\Models\Student;

use Illuminate\Http\Request;

interface StudentRepositoryInterface
{

    public function getAllStudents();
    public function createStudent();
    public function storeStudent($request);
    public function editStudent(Student $student);

    public function showStudent(Student $student);
    public function uploadAttachment( Student $student ,$request);
    public function downloadAttachment($student_name,$file_name);
    public function deleteAttachment($image);
    public function updateStudent(Student $student, $request);
    public function deleteStudent(Student $student);

    public function getData();


}
