<?php

namespace App\Http\Controllers\students\dashboard;

use App\Http\Controllers\Controller;
use App\Models\library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        $files = Library::with('grade','class','section','teacher')
             ->where('grade_id', auth()->user()->grade_id)
             ->where('class_id', auth()->user()->class_id)
             ->where('section_id', auth()->user()->section_id)
             ->paginate();
        return view('pages.students.dashboard.library.index',compact('files'));
    }

    public function downloadAttachment($file_title , $file_name)
    {
        try{
            return response()->download(public_path(library::Path.$file_title.'/'.$file_name));
        }catch (\Exception $exception){
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
