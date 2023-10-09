<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $teacher = Teacher::findOrFail(auth()->user()->id);
       return view('pages.teachers.profile' , compact('teacher'));
    }
    public function update( Request $request,$id)
    {
        $teacher = Teacher::findOrFail($id);
        $password = (!empty($request->password)) ? Hash::make($request->password) : $teacher->password;

        $request->validate([
            'password' => 'nullable|string|min:8',
            'Name_ar' => 'required|min:10|max:80',
            'Name_en' => 'required|min:10|max:80',
        ]);
        $teacher->update([
            'name'=> ['ar' =>$request->Name_ar , 'en'=> $request->Name_en ],
            'password'=> $password
        ]);

       return back()->with(['updated' => trans('messages.Update')]);
    }
}
