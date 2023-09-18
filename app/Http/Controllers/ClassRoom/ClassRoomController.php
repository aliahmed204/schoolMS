<?php

namespace App\Http\Controllers\ClassRoom;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRooms\StoreClassesRequest;
use App\Models\ClassRoom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    public function index( )
    {
        $classes = ClassRoom::with('grade')->get();
        $grades = Grade::get();
        //session()->put('info', trans('messages.welcome'));
        return view('pages.classRooms.index' , compact('classes' ,'grades'));
    }


    public function store(StoreClassesRequest $request)
    {
        $classes = $request->classes_list;
        try {
            foreach ( $classes as $class):
                // to check if this ClassRoom For Same-grade is existing in database
                $classRooms_check = ClassRoom::where(function ($query) use ($class) {
                    $query->where('name->ar', $class['name_ar'])
                          ->orWhere('name->en', $class['name']);
                })->where('grade_id', $class['grade_id'])
                    ->exists();

                if($classRooms_check){
                    return back()->withErrors(['exists' => trans('classRooms.exists')]);
                }

                // to insert single row to database every iteration inside the loop
                    $classes = new ClassRoom();
                    $classes->name = ['en' => $class['name'], 'ar' => $class['name_ar']];
                    $classes->grade_id = $class['grade_id'];
                    $classes->save();

            endforeach;
                return redirect()->route('classRooms.index')->with(['success1' => trans('messages.success')]);

        }catch (\Exception $exception){
            return redirect()->route('classRooms.index')->withErrors(['error' => $exception->getMessage()]);
        }

    }


    public function update(ClassRoom $classRoom , Request $request)
    {
        //// update validation

        // to check if this Grade is inside database
        $classRooms_check = ClassRoom::where(function ($query) use ($request) {
            $query->where('name->ar', $request->name_ar)
                ->orWhere('name->en', $request->name);
        })->whereNotIn('id', [$classRoom->id]) // exclude the current record
        ->exists();

        if($classRooms_check){
            return to_route('grades.index')->withErrors(['exists' => trans('grades.exists')]);
        }
        try {
            $classRoom->update([
                'name' => [
                    'en' => $request->name,
                    'ar' => $request->name_ar
                ],
                'grade_id'=>$request->grade_id,
            ]);

            return redirect()->route('classRooms.index')->with(['updated' => trans('messages.Update')]);

        }catch (\Exception $exception){
            return redirect()->route('classRooms.index')->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy(ClassRoom $classRoom)
    {
        try {
            $classRoom->delete();
            return redirect()->route('classRooms.index')->with(['deleted'=> trans('messages.Delete')]);
        }catch (\Exception $exception){
            return redirect()->route('classRooms.index')->withErrors(['error' => $exception->getMessage()]);
        }

    }

    public function delete_all(Request $request)
    {
        $IDs = explode(',',$request->delete_all_id);
        try {
            ClassRoom::destroy($IDs);  //== ClassRoom::whereIn('id' ,$IDs)->delete();
            return redirect()->route('classRooms.index')->with(['deleted'=> trans('messages.Delete')]);
        }catch (\Exception $exception){
            return redirect()->route('classRooms.index')->withErrors(['error' => $exception->getMessage()]);
        }

    }

    public function filterClasses(Request $request){
        $search = ClassRoom::where('grade_id' , $request->grade_id)->with('grade')->get();
        $grades = Grade::get();
        return view('pages.classRooms.index' , compact('grades'))->withDetails($search);
    }

}
