<?php

namespace App\Repositories;

use App\Http\traits\UploadFile;
use App\Interfaces\StudentRepositoryInterface;
use App\Models\BloodType;
use App\Models\ClassRoom;
use App\Models\Genders;
use App\Models\Grade;
use App\Models\Image;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Specialization;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class StudentRepository implements StudentRepositoryInterface
{

    use UploadFile ;
    public function getAllStudents()
    {
        $students = Student::with('gender','grade','class','section')->paginate();
        return view('pages.students.index', compact('students'));
    }

    public function createStudent()
    {
        $data = $this->getData();
        return view('pages.students.create', $data);
    }

    public function storeStudent($request)
    {
        DB::beginTransaction();
        try {
            $student = Student::create([
                'name'=>['ar' => $request->name_ar, 'en' =>  $request->name_en],
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender_id' => $request->gender_id,
                'nationality_id' => $request->nationality_id,
                'blood_id' => $request->blood_id,
                'date_of_birth' => $request->date_of_birth,
                'grade_id' => $request->grade_id,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'parent_id' => $request->parent_id,
                'academic_year' => $request->academic_year,
            ]);
            // insert img
            if($request->hasfile('photos'))
            {
                foreach($request->file('photos') as $file) {
                    $file_name = $this->UploadFile($file, Student::Path, $student->getTranslation('name','en'));
                    Image::create([
                        'file_name' => $file_name,
                        'imageable_id' => $student->id,
                        'imageable_type' => Student::class,
                    ]);
                }
            }
            DB::commit(); // insert data
            return redirect()->route('students.index')->with(['success1' => trans('messages.success')]);
        }
        catch (\Exception $exception){
            DB::rollback();
            return redirect()->route('students.index')->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function showStudent(Student $student){
        return view('pages.students.show',compact('student') );
    }
    public function uploadAttachment(Student $student,$request){
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
    public function downloadAttachment($student_name,$file_name){
        try{
            return response()->download(public_path(Student::Path.$student_name.'/'.$file_name));
        }catch (\Exception $exception){
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
    public function deleteAttachment($image){
        try{
            $this->DeleteFile($image->imageable->name ,$image->file_name);
            $image->delete();
            return back()->with(['imageDeleted' => trans('messages.success')]);
        }catch (\Exception $exception){
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }



    public function editStudent(Student $student)
    {
        $data = $this->getData();
        return view('pages.students.edit', $data ,compact('student'));
    }

    public function updateStudent(Student $student, $request)
    {
        DB::beginTransaction();
        try {
            $student =   $student->update([
                'name'=>['ar' => $request->name_ar, 'en' =>  $request->name_en],
                'email' => $request->email,
                'password' => Hash::make($request->password) ?? $student->password,
                'gender_id' => $request->gender_id,
                'nationality_id' => $request->nationality_id,
                'blood_id' => $request->blood_id,
                'date_of_birth' => $request->date_of_birth,
                'grade_id' => $request->grade_id,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'parent_id' => $request->parent_id,
                'academic_year' => $request->academic_year,
            ]);
            DB::commit(); // insert data
            return redirect()->route('students.index')->with(['updated' => trans('messages.success')]);
        }
        catch (\Exception $exception){
            DB::rollback();
            return redirect()->route('students.index')->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function deleteStudent(Student $student)
    {
        try {
            $student->delete();
            return redirect()->route('students.index')->with(['deleted'=> trans('messages.Delete')]);
        }catch (\Exception $exception){
            return redirect()->route('students.index')->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function getData(){
       return [
            'grades'     => Grade::get(),
            'parents'     => StudentParent::latest()->get(),
            'genders'     => Genders::get(),
            'nationalities' => Nationality::get(),
            'bloods'       => BloodType::get(),
        ];
    }

}
