<?php

namespace App\Repositories\question;

use App\Interfaces\question\questionRepositoryInterface;

use App\Models\Grade;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\Teacher;

class questionRepository implements questionRepositoryInterface
{

    public function index()
    {
        $questions = Question::with('quiz')->paginate();
        return view('pages.questions.index', compact('questions'));
    }

    public function create()
    {
        $quizzes = Quiz::latest()->get();
        return view('pages.questions.create' ,compact('quizzes') );
    }

    public function store($request)
    {
        try {
            Question::create([
                'title'        => $request->title,
                'answers'      => $request->answers,
                'right_answer' => $request->right_answer,
                'score'        => $request->score,
                'quiz_id'      => $request->quiz_id
            ]);
            return redirect()->route('questions.index')->with(['success1' => trans('messages.success')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit(Question $question)
    {
        $quizzes = Quiz::latest()->get();
        return view('pages.questions.edit',compact('question' ,'quizzes' ) );
    }

    public function update(Question $question, $request)
    {
        try {
            $question->update([
                'title'        => $request->title,
                'answers'      => $request->answers,
                'right_answer' => $request->right_answer,
                'score'        => $request->score,
                'quiz_id'      => $request->quiz_id
            ]);
            return redirect()->route('questions.index')->with(['updated' => trans('messages.updated')]);
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
