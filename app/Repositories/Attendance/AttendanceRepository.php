<?php

namespace App\Repositories\Attendance;

use App\Interfaces\Attendance\AttendanceRepositoryInterface;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;

class AttendanceRepository implements AttendanceRepositoryInterface
{

    public function index()
    {
        $grades    = Grade::with('sections')->get();
        $allGrades = Grade::select('id','name')->get();
        $teachers  = Teacher::get();
        return view('pages.Attendance.Sections',compact('grades','allGrades','teachers'));
    }

    public function show($id)
    {
        $section = Section::select('id')->findOrFail($id);
        $students = Student::where('section_id',$section->id)
            ->with('attendance','gender','grade','class','section')->paginate();

        return view('pages.Attendance.index',compact('students' , 'section' ));
    }

    public function store($section_id ,$request)
    {
        $section = Section::findOrFail($section_id);
        $grade_id = $section->grade_id;
        $class_id = $section->class_id;

        try {
            foreach ($request->attendences as $student_id => $attendence) {
                if( $attendence == 'presence' ) {
                    $status = true;
                } else if( $attendence == 'absent' ){
                    $status = false;
                }
                Attendance::create([
                    'student_id'=> $student_id,
                    'grade_id'  => $grade_id,
                    'class_id'  => $class_id,
                    'section_id'=> $section->id,
                    'teacher_id'=> auth()->user()->id,  // should be teacher
                    'for_day'   => date('Y-m-d'),
                    'status'    => $status
                ]);
            }
            return redirect()->back()->with(['success1' => trans('messages.success')]);
        }
        catch (\Exception $exception){
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

}
