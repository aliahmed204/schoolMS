<?php

namespace App\Http\Controllers\students\dashboard;

use App\Http\Controllers\Controller;
use App\Http\traits\UploadFile;
use App\Models\Image;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use UploadFile;

    public function index()
    {
        $student = Student::findOrFail(auth()->user()->id);
        $attachments = $student->images()->paginate(1);
        return view('pages.students.dashboard.profile' , compact('student' ,'attachments'));
    }


    public function upload_attachment(Student $student,Request $request)
    {
        $request->validate([
            'photos' => 'required|array',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);
        try{
            foreach($request->file('photos') as $file) {
                $file_name = $this->UploadFile($file, Student::Path, $student->getTranslation('name','en'));
                Image::create([
                    'file_name' => $file_name,
                    'imageable_id' => $student->id,
                    'imageable_type' => Student::class,
                ]);
            }
            return back()->with(['success1' => trans('messages.success')]);
        }catch (\Exception $exception){
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
    public function download_attachment($student_name,$file_name)
    {
        try{
            return response()->download(public_path(Student::Path.$student_name.'/'.$file_name));
        }catch (\Exception $exception){
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }


    public function update( Request $request,$id)
    {
        $student = Student::findOrFail($id);
        $password = (!empty($request->password)) ? Hash::make($request->password) : $student->password;

        $request->validate([
            'password' => 'nullable|string|min:8',
            'Name_ar' => 'required|min:10|max:80',
            'Name_en' => 'required|min:10|max:80',
        ]);
        $student->update([
            'name'=> ['ar' =>$request->Name_ar , 'en'=> $request->Name_en ],
            'password'=> $password
        ]);

        return back()->with(['updated' => trans('messages.Update')]);
    }
}
