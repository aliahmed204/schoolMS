<?php

namespace App\Repositories\subject;

use App\Interfaces\subjects\subjectRepositoryInterface;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

class subjectRepository implements subjectRepositoryInterface
{

    public function index()
    {
        $subjects = Subject::with('grade','class','teacher')->paginate();
        return view('pages.subjects.index',compact('subjects'));
    }

    public function create()
    {
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('pages.subjects.create',compact('grades' , 'teachers'));

    }

    public function store($request)
    {
        try {
            Subject::create([
                'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'grade_id' => $request->grade_id ,
                'class_id' => $request->class_id ,
                'teacher_id' => $request->teacher_id ,
            ]);
            return redirect()->route('subjects.index')->with(['success1' => trans('messages.success')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit(Subject $subject)
    {
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('pages.subjects.edit',compact('grades' , 'teachers','subject'));
    }

    public function update(Subject $subject, $request)
    {
        try {
            $subject->update([
                'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'grade_id' => $request->grade_id ,
                'class_id' => $request->class_id ,
                'teacher_id' => $request->teacher_id ,
            ]);
            return redirect()->route('subjects.index')->with(['updated' => trans('messages.updated')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Subject $subject)
    {
        try {
            $subject->delete();
            return back()->with(['deleted'=> trans('messages.Delete')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
