<?php

namespace App\Repositories\quiz;

use App\Interfaces\Quiz\quizRepositoryInterface;
use App\Models\Grade;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\Teacher;

class quizRepository implements quizRepositoryInterface
{

    public function index()
    {
        $quizzes = Quiz::with('subject','teacher','class','grade','section')->paginate(35);
        return view('pages.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $data = $this->getData();
        return view('pages.quizzes.create' ,$data );
    }

    public function store($request)
    {
        try {
            Quiz::create([
                'name'        => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'subject_id' => $request->subject_id ,
                'teacher_id' => $request->teacher_id ,
                'grade_id'   => $request->grade_id ,
                'class_id'    => $request->class_id ,
                'section_id'  => $request->section_id ,
            ]);
            return redirect()->route('quizzes.index')->with(['success1' => trans('messages.success')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit(Quiz $quiz)
    {
        $data = $this->getData();
        return view('pages.quizzes.edit',$data,compact('quiz' ) );
    }

    public function update(Quiz $quiz, $request)
    {
        try {
            $quiz->update([
                'name'        => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'subject_id ' => $request->subject_id ,
                'teacher_id ' => $request->teacher_id ,
                'grade_id '   => $request->grade_id ,
                'class_id'    => $request->class_id ,
                'section_id'  => $request->section_id ,
            ]);
            return redirect()->route('quizzes.index')->with(['updated' => trans('messages.updated')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Quiz $quiz)
    {
        try {
            $quiz->delete();
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
