<?php

namespace App\Http\Controllers\students;

use App\Http\Controllers\Controller;
use App\Interfaces\StudentGraduatedRepositoryInterface;
use App\Models\Student;
use App\Repositories\StudentGraduatedRepository;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    public StudentGraduatedRepositoryInterface $studentGraduatedRepository;
    public function __construct( StudentGraduatedRepositoryInterface $studentGraduatedRepository){
        return $this->studentGraduatedRepository = $studentGraduatedRepository ;
    }
    public function index()
    {
        return $this->studentGraduatedRepository->getGraduatedStudents();
    }

    public function create()
    {
        return $this->studentGraduatedRepository->create();
    }

    public function softDelete(Request $request)
    {
        return $this->studentGraduatedRepository->softDelete($request);
    }
    public function studentSoftDelete(Student $student)
    {
        return $this->studentGraduatedRepository->studentSoftDeleteById($student);
    }

    /**
     * Display the specified resource.
     */
    public function destroy($id)
    {
        return $this->studentGraduatedRepository->forceDelete($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function restore($id)
    {
        return $this->studentGraduatedRepository->restore($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

}
