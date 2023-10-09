<?php

namespace App\Repositories;


use App\Interfaces\StudentGraduatedRepositoryInterface;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\http\Request;




class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface
{
    public function getGraduatedStudents()
    {
        $students = Student::onlyTrashed()
            ->with('gender','grade','class','section')
            ->paginate();
        return view('pages.students.graduated.index', compact('students'));

    }

    public function create()
    {
        $grades = Grade::get();
        return view('pages.students.graduated.create', compact('grades'));
    }
    public function softDelete(Request $request)
    {
        $students = Student::where('grade_id',$request->grade_id)
            ->Where('class_id',$request->class_id)
            ->Where('section_id' , $request->section_id)
            ->Where('academic_year' , $request->academic_year)
            ->get();
        if($students->count() == 0 ){
            return back()->with(['error_Graduated' => __('Students_trans.error_graduate')]);
        }
    try{
       foreach ($students as $student){
           $ids = explode(',',$student->id);
           Student::whereIn('id',$ids)->delete();
       }
        return back()->with(['success1' => trans('messages.success')]);
    }
    catch (\Exception $exception){
        return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
    public function studentSoftDeleteById(Student $student)
    {
        try{
            $student->delete();
            return back()->with(['success1' => trans('messages.success')]);
        }
        catch (\Exception $exception){
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function forceDelete($id)
    {
        try {
            Student::onlyTrashed()->where('id', $id)->first()->forceDelete();
            return back()->with(['Delete' => trans('messages.Delete')]);
        }catch (\Exception $exception){
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function restore($id)
    {
        try {
            Student::onlyTrashed()->where('id',$id)->first()->restore();
            return back()->with(['restored' => trans('messages.restored')]);
        }catch (\Exception $exception){
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }


}
