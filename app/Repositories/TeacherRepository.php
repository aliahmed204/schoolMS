<?php

namespace App\Repositories;

use App\Interfaces\TeacherRepositoryInterface;
use App\Models\Genders;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class TeacherRepository implements TeacherRepositoryInterface
{

    public function getAllTeachers()
    {
        return Teacher::with('gender','specialization')->paginate();
    }

    public function getAllSpecializations()
    {
        return Specialization::get();
    }
    public function getAllGenders()
    {
        return Genders::get();
    }

    public function createTeacher($request)
    {
        try{
            Teacher::create([
                'name'=>['ar' => $request->name_ar, 'en' =>  $request->name_en],
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'joining_date' => $request->joining_date,
                'address' => $request->address,
                'specialization_id' => $request->specialization_id,
                'gender_id' => $request->gender_id,
            ]);
            return redirect()->route('teachers.index')->with(['success1' => trans('messages.success')]);
        }catch(\Exception $exception){
            return redirect()->route('teachers.index')->withErrors(['error' => $exception->getMessage()]);
        }
    }
    public function updateTeacher(Teacher $teacher, $request)
    {
        try {
            $teacher->update([
                'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'email' => $request->email,
                'password' => $request->password ?? $teacher->password,
                'joining_date' => $request->joining_date,
                'address' => $request->address,
                'specialization_id' => $request->specialization_id,
                'gender_id' => $request->gender_id,
            ]);
            return back()->with(['updated' => trans('messages.Update')]);
        } catch (\Exception $exception) {
            return redirect()->route('teachers.index')->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function deleteTeacher(Teacher $teacher)
    {
        try {
            $teacher->delete();
            return redirect()->route('teachers.index')->with(['deleted'=> trans('messages.Delete')]);
        }catch (\Exception $exception){
            return redirect()->route('teachers.index')->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
