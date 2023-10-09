<?php

namespace App\Http\Controllers\students\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index(){
        // student quiz
        $userId =  auth()->user()->id;
        $quizzes = Quiz::with('subject')
            ->where('grade_id', auth()->user()->grade_id)
            ->where('class_id', auth()->user()->class_id)
            ->where('section_id', auth()->user()->section_id)
            ->get();

        return view('pages.students.dashboard.exam.index', compact('quizzes' ));
    }

    public function show($quiz_id)
    {
        $student_id = Auth::user()->id;
        return view('pages.students.dashboard.exam.show',compact('quiz_id','student_id'));
    }

}
