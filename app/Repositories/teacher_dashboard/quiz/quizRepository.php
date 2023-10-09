<?php

namespace App\Repositories\teacher_dashboard\quiz;


use App\Interfaces\teacherDashboard\Quiz\quizRepositoryInterface;
use App\Models\ClassRoom;
use App\Models\Degree;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class quizRepository implements quizRepositoryInterface
{

    public function index()
    {
        $quizzes = Quiz::teacherQuiz()->with('subject','teacher','class','grade','section')->paginate();
        return view('pages.teachers.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $data = $this->getData();
        return view('pages.teachers.quizzes.create' ,$data );
    }

    public function store($request)
    {
        try {
            Quiz::create([
                'name'        => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'subject_id'  => $request->subject_id ,
                'teacher_id'  => $request->teacher_id ,
                'grade_id'    => $request->grade_id ,
                'class_id'    => $request->class_id ,
                'section_id'  => $request->section_id ,
            ]);
            return redirect()->route('teacher.quizzes.index')->with(['success1' => trans('messages.success')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit(Quiz $quiz)
    {
        $data = $this->getData();
        return view('pages.teachers.quizzes.edit',$data,compact('quiz' ) );
    }

    public function update(Quiz $quiz, $request)
    {
        try {
            $quiz->update([
                'name'        => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'subject_id ' => $request->subject_id ,
                'teacher_id ' => $request->teacher_id ,
                'grade_id '   => $request->grade_id ,
                'class_id'    => $request->class_id ,
                'section_id'  => $request->section_id ,
            ]);
            return redirect()->route('teacher.quizzes.index')->with(['updated' => trans('messages.updated')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Quiz $quiz)
    {
        try {
            $quiz->delete();
            return back()->with(['deleted'=> trans('messages.Delete')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function getData()
    {
        $subjects  = Subject::teacherSubjects()->get();
        $teacher = Teacher::findOrFail(auth()->user()->id);
        // get teacherGrades throw teachers relation with sections
        foreach($teacher->sections as $section){
            $teacherGrades[] = $section->grade;
        };
        $grades = collect($teacherGrades)->unique()->values()->all();
        return [
            'subjects' => $subjects,
            'teacher'  => $teacher,
            'grades'   => $grades,
        ];
    }

    public function student_finished(Quiz $quiz){
        $degrees = Degree::select('*')
            ->whereIn('id', function ($query) use ($quiz) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('degrees')
                    ->where('quiz_id', $quiz->id)
                    ->groupBy('student_id');
            })->with('student', 'quiz', 'question')->paginate();

        return  view('pages.teachers.quizzes.student_degree' ,compact('degrees'  ) );
    }

    public function student_answers(Quiz $quiz ,Student $student){
        $degrees = Degree::where('quiz_id',$quiz->id)->where('student_id',$student->id)
            ->with('student','quiz','question')
            ->paginate();
        return  view('pages.teachers.quizzes.student_answers' ,compact('degrees'  ) );
    }
    public function repeat_quiz(Quiz $quiz ,Student $student){
        Degree::where('quiz_id',$quiz->id)
            ->where('student_id',$student->id)
            ->destroy();
         return back()->with(['repeat'=> trans('messages.repeat')]);
    }

}
