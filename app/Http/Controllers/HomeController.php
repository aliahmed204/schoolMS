<?php

namespace App\Http\Controllers;

use App\Models\FeeInvoice;
use App\Models\OnlineClass;
use App\Models\Quiz;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index(){
        return view('auth.selection');
    }

    public function dashboard(){

        $data ['students'] = Student::count();
        $data ['teachers'] = Teacher::count();
        $data ['studentParents'] = StudentParent::count();
        $data ['sections'] = Section::count();

        $data ['latest_students'] = Student::latest()->take(5)->get();
        $data ['latest_teachers'] = Teacher::latest()->take(5)->get();
        $data ['latest_studentParents'] =StudentParent::latest()->take(5)->get();
        $data ['latest_invoices'] = FeeInvoice::latest()->take(10)->get();


        return view('dashboard' , $data);
    }
    public function student_dashboard(){
        return view('pages.students.dashboard');
    }

    public function teacher_dashboard()
    {
         // teacher sections [ids] many-to-many
        $ids = Teacher::findOrFail(auth()->user()->id)->sections()->pluck('section_id');

        $data['sections_count'] = $ids->count();

        $data['students'] = Student::whereIn('section_id',$ids)
                ->latest()->take(10)->paginate(5);// teacher students debind on teacher-sections

        $data['students_count'] = Student::whereIn('section_id',$ids)->count();

        $data['quizzes']  = Quiz::teacherQuiz()
            ->with('subject','class','grade','section')
            ->latest()->take(10)->paginate(5);

        $data['onlineClasses'] = OnlineClass::createdBy()
            ->with('class','grade','section')
            ->latest()->take(10)->paginate(5);

        return view('pages.teachers.dashboard' ,$data);
    }



    public function parent_dashboard(){

        $sons = Student::parentChild()->get();
        return view('pages.parent.dashboard' ,compact('sons'));
    }
}
