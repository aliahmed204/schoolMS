<?php

namespace App\Repositories\Section;

use App\Http\Requests\Sectoins\StoreSectionRequest;
use App\Http\Requests\Sectoins\UpdateSectionRequest;
use App\Interfaces\Section\SectionRepositoryInterface;
use App\Models\ClassRoom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;

class SectionRepository implements SectionRepositoryInterface
{

    public function index()
    {
        $grades = Grade::with('sections')->get();
        $classes  = ClassRoom::with('sections')->get();
        $allGrades = Grade::select('id','name')->get();
        $teachers = Teacher::get();
        return view('pages.sections.index' , compact('allGrades' ,'classes','grades','teachers'));
    }

    public function store(StoreSectionRequest $request)
    {
        // check if new section name is existing in same classRoom
        $sections_check = Section::where(function ($query) use ($request) {
            $query->where('name->ar', $request->name_ar)
                ->orWhere('name->en', $request->name);
        })->where('class_id', $request->class_id)
            ->exists();
        if($sections_check){
            return back()->withErrors(['exists' => trans('classRooms.exists')]);
        }

        try {
            $section = Section::create([
                'name' => [
                    'en' => $request->name,
                    'ar' => $request->name_ar,
                ],
                'grade_id'=>$request->grade_id,
                'class_id'=>$request->class_id,
                'status'=> '1',
            ]);
            $section->teachers()->attach($request->teacher_id);

            return redirect()->route('sections.index')->with(['success1' => trans('messages.success')]);

        }catch (\Exception $exception){
            return redirect()->route('sections.index')->withErrors(['error' => $exception->getMessage()]);
        }

    }

    public function update(Section $section , UpdateSectionRequest $request)
    {

        // to check if this section is inside database
        $sections_check = Section::where(function ($query) use ($request) {
            $query->where('name->ar', $request->name_ar)
                ->orWhere('name->en', $request->name);
        })->whereNotIn('id', [$section->id]) // exclude the current record
        ->exists();

        if($sections_check){
            return to_route('grades.index')->withErrors(['exists' => trans('grades.exists')]);
        }

        $status =  isset($request->status) ? '1' : '0' ;
        // update or delete teachers in this sections
        $section->teachers()->sync($request->input('teacher_id', []));

        try {
            $section->update([
                'name' => [
                    'en' => $request->name,
                    'ar' => $request->name_ar
                ],
                'grade_id'=>$request->grade_id,
                'class_id'=>$request->class_id,
                'status'=>$status,
            ]);

            return redirect()->route('sections.index')->with(['updated' => trans('messages.Update')]);

        }catch (\Exception $exception){
            return redirect()->route('sections.index')->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy(Section $section)
    {
        try {
            $section->delete();
            return redirect()->route('sections.index')->with(['deleted'=> trans('messages.Delete')]);
        }catch (\Exception $exception){
            return redirect()->route('sections.index')->withErrors(['error' => $exception->getMessage()]);
        }

    }
}
