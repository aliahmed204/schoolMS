<?php

namespace App\Http\Controllers\parent\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teachers\setudents\attendance\AttendaceReportRequest;
use App\Http\traits\UploadFile;
use App\Models\Attendance;
use App\Models\Degree;
use App\Models\Fee;
use App\Models\FeeInvoice;
use App\Models\Image;
use App\Models\Quiz;
use App\Models\ReceiptStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChildrenController extends Controller
{
    use UploadFile;
    public function index(){
        $students = Student::parentChild()->with('gender','grade','class','section')->paginate();
        return view('pages.parent.dashboard.index' ,compact('students'));
    }

    public function show(Student $student){
        //to show only quiz-name and its degree
        $degrees   = Degree::select('*')
            ->whereIn('id', function ($query) use ($student) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('degrees')
                    ->where('student_id', $student->id)
                    ->groupBy('quiz_id');
            })->with('student', 'quiz', 'question')->get();
        return view('pages.parent.dashboard.show',compact('student' , 'degrees') );
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


    public function student_answers(Quiz $quiz ,Student $student)
    {
        $degrees = Degree::where('quiz_id',$quiz->id)->where('student_id',$student->id)
            ->with('student','quiz','question')
            ->paginate();
        return  view('pages.parent.dashboard.student_answers' ,compact('degrees'  ) );
    }


    public function attendance_report()
    {
        $allStudents = Student::parentChild()->get();
        return view('pages.parent.dashboard.attendance_reports', compact('allStudents'));
    }


    public function attendance_search(AttendaceReportRequest $request)
    {
        $allStudents = Student::parentChild()->get();
        $students_attendance = Attendance::whereBetween('for_day', [$request->from, $request->to])
            ->where('student_id', $request->student_id)->latest()->take(14)->get();
        return view('pages.parent.dashboard.attendance_reports', compact('allStudents', 'students_attendance'));

    }

    public function fees()
    {
        $students = Student::parentChild()->pluck('id');
        $invoices = FeeInvoice::whereIn('student_id',$students)
            ->orderBy('student_id')
            ->paginate();
        return view('pages.parent.dashboard.fee', compact('invoices'));
    }
    public function receipt($id)
    {
        $student = Student::FindOrFail($id);
        $receipts = ReceiptStudent::where('student_id','=',$student->id)
            ->paginate();
        if($receipts->count() > 0 ) {
            return view('pages.parent.dashboard.receipt', compact('receipts'));
        }else{
            return back()->with(['noReceipt' => trans('messages.noReceipt')]);
        }
    }




}
