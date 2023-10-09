<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teachers\setudents\attendance\AttendaceReportRequest;
use App\Models\Attendance;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
        $students = $allStudents = $this->teacher_students(true);
        return view('pages.teachers.students.index' ,compact('students'));
    }

    public function attendance(Request $request)
    {
        $request->validate([
            'attendences' => 'required|array',
            'attendences.*' => 'required|in:presence,absent',
        ]);
        try {
            foreach ($request->attendences as $student_id => $attendence) {
                if( $attendence == 'presence' ) {
                    $status = true;
                } else if( $attendence == 'absent' ){
                    $status = false;
                }
                $student = Student::find($student_id);
                Attendance::updateOrCreate(['student_id' => $student->id , 'for_day'=> date('Y-m-d') ],[
                    'student_id'=> $student->id,
                    'grade_id'  => $student->grade_id,
                    'class_id'  => $student->class_id,
                    'section_id'=> $student->section_id,
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
    public function attendance_report()
    {
        $allStudents = $this->teacher_students();
        return view('pages.Teachers.students.attendance_reports', compact('allStudents'));
    }


    public function attendance_search(AttendaceReportRequest $request)
    {
        $allStudents = $this->teacher_students();
        if ($request->student_id == 0) {
            $students_attendance = Attendance::whereBetween('for_day', [$request->from, $request->to])->get();
            return view('pages.Teachers.students.attendance_reports', compact('allStudents', 'students_attendance'));
        } else {
            $students_attendance = Attendance::whereBetween('for_day', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('pages.Teachers.students.attendance_reports', compact('allStudents', 'students_attendance'));
        }
    }

    private function teacher_students($with= false)
    {
        $ids = Teacher::findOrFail(auth()->user()->id)->sections()->pluck('section_id');
        if($with){
            return Student::whereIn('section_id',$ids)->with('gender','grade','class','section')->paginate();
        }else{
            return Student::whereIn('section_id',$ids)->get();
        }
    }
}
