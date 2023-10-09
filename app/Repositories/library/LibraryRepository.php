<?php

namespace App\Repositories\library;

use App\Http\traits\UploadFile;
use App\Interfaces\library\LibraryRepositoryInterface;
use App\Models\Grade;
use App\Models\library;
use App\Models\Teacher;
use Illuminate\Http\Request;

class LibraryRepository implements LibraryRepositoryInterface
{
    use UploadFile;

    public function index()
    {
        $files = Library::with('grade','class','section','teacher')->paginate();
        return view('pages.library.index',compact('files'));
    }

    public function create()
    {
        $data = $this->getData();
        return view('pages.library.create',$data);
    }

    public function store(Request $request)
    {
        $file = $request->file('file_name') ;
        $file_name = $this->UploadFile($file, library::Path , $request->title);
        try {
            library::create([
                'title'      => $request->title,
                'teacher_id' => $request->teacher_id,
                'grade_id'   => $request->grade_id,
                'class_id'   => $request->class_id,
                'section_id' => $request->section_id,
                'file_name'  => $file_name,
            ]);
            // $this->uploadFile($request,'file_name');
            return redirect()->route('library.index')->with(['success1' => trans('messages.success')]);
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit(library $library)
    {
        $data = $this->getData();
        return view('pages.library.edit',$data,compact('library'));
    }

    public function update(Request $request, library $library)
    {
        try {
            if($request->hasfile('file_name')){
                $this->DeleteFile($library->title,$library->file_name,library::Path);
                $file_name = $this->UploadFile($request->file('file_name'), library::Path , $request->title);
            }
            $library->update([
                'title'      => $request->title,
                'teacher_id' => $request->teacher_id,
                'grade_id'   => $request->grade_id,
                'class_id'   => $request->class_id,
                'section_id' => $request->section_id,
                'file_name'  => $file_name ?? $library->file_name ,
            ]);
            return redirect()->route('library.index')->with(['updated' => trans('messages.success')]);
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(library $library)
    {
        try{
            $this->DeleteFile($library->title,$library->file_name,library::Path);
            $library->delete();
            return redirect()->route('library.index')->with(['deleted' => trans('messages.Delete')]);
        }catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }
    public function downloadAttachment($file_title , $file_name)
    {
        try{
            return response()->download(public_path(library::Path.$file_title.'/'.$file_name));
        }catch (\Exception $exception){
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function getData(){
        return
            [
             'grades' => Grade::get(),
             'teachers' => Teacher::get(),
            ];
    }
}
