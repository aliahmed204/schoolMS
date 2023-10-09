<?php

namespace App\Http\Controllers\students;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Interfaces\StudentRepositoryInterface;
use App\Models\Image;
use App\Models\Student;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    private StudentRepositoryInterface $studentRepository;
    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }
    public function index(){
        return $this->studentRepository->getAllStudents();
    }
    public function create()
    {
        return $this->studentRepository->createStudent();
    }
    public function store(StoreStudentRequest $request)
    {
        return $this->studentRepository->storeStudent($request);
    }

    public function show(Student $student)
    {
        return $this->studentRepository->showStudent($student);
    }
    public function upload_attachment(Student $student,Request $request)
    {
        return $this->studentRepository->uploadAttachment($student,$request);
    }
    public function download_attachment( $student_name, $file_name)
    {
        return $this->studentRepository->downloadAttachment($student_name,$file_name);
    }
    public function delete_attachment( Image $image )
    {
        return $this->studentRepository->deleteAttachment($image);
    }

    public function edit(Student $student)
    {
        return $this->studentRepository->editStudent($student);
    }
    public function update(Student $student ,UpdateStudentRequest $request)
    {
        return $this->studentRepository->updateStudent($student , $request);
    }
    public function destroy(Student $student){
        return $this->studentRepository->deleteStudent($student);
    }

}
