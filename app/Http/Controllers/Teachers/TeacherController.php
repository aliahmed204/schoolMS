<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teachers\StoreTeacherRequest;
use App\Interfaces\TeacherRepositoryInterface;
use App\Models\Teacher;
use Illuminate\Http\Request;


class TeacherController extends Controller
{
    private TeacherRepositoryInterface $teacherRepository;

    public function __construct(TeacherRepositoryInterface $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function index(){
        $teachers = $this->teacherRepository->getAllTeachers();
        return view('pages.teachers.index' , compact('teachers'));
    }

    public function create(){
        $specializations = $this->teacherRepository->getAllSpecializations();
        $genders = $this->teacherRepository->getAllGenders();
        return view('pages.teachers.create' , compact('specializations','genders'));
    }

    public function store(StoreTeacherRequest $request){
        return $this->teacherRepository->createTeacher($request);
    }

    public function edit(Teacher $teacher){
        $specializations = $this->teacherRepository->getAllSpecializations();
        $genders = $this->teacherRepository->getAllGenders();
        return view('pages.teachers.edit' , compact('teacher','specializations','genders'));
    }

    public function update(Teacher $teacher ,Request $request)
    {
        return $this->teacherRepository->updateTeacher( $teacher , $request);
    }

    public function destroy(Teacher $teacher){
        return $this->teacherRepository->deleteTeacher($teacher);
    }
}
