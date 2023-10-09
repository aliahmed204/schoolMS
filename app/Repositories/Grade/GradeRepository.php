<?php

namespace App\Repositories\Grade;

use App\Http\Requests\Grades\StoreGradesRequest;
use App\Http\Requests\Grades\UpdateGradesRequest;
use App\Interfaces\Grade\GradeRepositoryInterface;
use App\Models\ClassRoom;
use App\Models\Grade;

class GradeRepository implements GradeRepositoryInterface
{

    public function index()
    {
        $grades = Grade::paginate(10);
        return view('pages.grades.index' , compact('grades'));
    }

    public function store( $request)
    {
        try {
            Grade::create([
                'name' => [
                    'en' => $request->name,
                    'ar' => $request->name_ar
                ],
                'notes'=>$request->notes,
            ]);
            session()->put('success' , trans('messages.success'));
            return redirect()->route('grades.index')->with(['success1' => trans('messages.success')]);

        }catch (\Exception $exception){
            return redirect()->route('grades.index')->withErrors(['error' => $exception->getMessage()]);
        }

    }


    public function update(Grade $grade , $request)
    {
        // to check if this Grade is inside database
        $grade_check = Grade::where(function ($query) use ($request) {
            $query->where('name->ar', $request->name_ar)
                ->orWhere('name->en', $request->name);
        })->whereNotIn('id', [$grade->id]) // exclude the current record
        ->exists();

        if($grade_check){
            return to_route('grades.index')->withErrors(['exists' => trans('grades.exists')]);
        }

        try {
            $grade->update([
                'name' => [
                    'en' => $request->name,
                    'ar' => $request->name_ar
                ],
                'notes'=>$request->notes,
            ]);

            return redirect()->route('grades.index')->with(['updated' => trans('messages.success')]);

        }catch (\Exception $exception){
            return redirect()->route('grades.index')->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy(Grade $grade)
    {
        $child = ClassRoom::where('grade_id' , $grade->id)->pluck('grade_id');
        if($child->count() > 0){
            return redirect()->route('grades.index')->with(['hasChild'=> trans('grades.delete_Grade_Error')]);
        }

        try {
            $grade->delete();
            return redirect()->route('grades.index')->with(['deleted'=> trans('messages.Delete')]);
        }catch (\Exception $exception){
            return redirect()->route('grades.index')->withErrors(['error' => $exception->getMessage()]);
        }

    }

}
