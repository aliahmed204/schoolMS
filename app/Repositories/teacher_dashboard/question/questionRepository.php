<?php

namespace App\Repositories\teacher_dashboard\question;

use App\Interfaces\teacherDashboard\question\questionRepositoryInterface;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\Teacher;

class questionRepository implements questionRepositoryInterface
{

    public function index($id)
    {
        $quiz = Quiz::findOrFail($id);
        $questions = Question::where('quiz_id',$quiz->id)->with('quiz')->paginate();
        return view('pages.teachers.questions.index',compact('questions','quiz'));
    }

    public function create($id)
    {
        return view('pages.teachers.questions.create' ,compact('id') );
    }

    public function store($request , $id)
    {
        $quiz = Quiz::findOrFail($id);
        try {
            Question::create([
                'title'        => $request->title,
                'answers'      => $request->answers,
                'right_answer' => $request->right_answer,
                'score'        => $request->score,
                'quiz_id'      => $quiz->id
            ]);
            return redirect()->route('teacher.questions.index',$quiz->id)->with(['success1' => trans('messages.success')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit(Question $question )
    {
        return view('pages.teachers.questions.edit',compact('question') );
    }

    public function update(Question $question, $request)
    {
        try {
            $question->update([
                'title'        => $request->title,
                'answers'      => $request->answers,
                'right_answer' => $request->right_answer,
                'score'        => $request->score,
                'quiz_id'      => $question->quiz_id
            ]);
            return redirect()->route('teacher.questions.index',$question->quiz_id)->with(['updated' => trans('messages.updated')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Question $question)
    {
        try {
            $question->delete();
            return back()->with(['deleted'=> trans('messages.Delete')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getData(){
        return [
            'subjects'  => Subject::get(),
            'teachers'  => Teacher::get(),
            'grades'    => Grade::get(),
        ];
    }
}
