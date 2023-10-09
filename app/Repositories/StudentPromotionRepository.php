<?php

namespace App\Repositories;

use App\Http\traits\UploadFile;
use App\Interfaces\StudentPromotionRepositoryInterface;
use App\Models\BloodType;
use App\Models\ClassRoom;
use App\Models\Genders;
use App\Models\Grade;
use App\Models\Image;
use App\Models\Nationality;
use App\Models\Promotion;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class StudentPromotionRepository implements StudentPromotionRepositoryInterface
{

    use UploadFile ;
    public function promotionIndex()
    {
        $grades = Grade::get();
        return view('pages.students.promotion.index', compact('grades'));
    }
    public function submitPromotion($request)
    {
        $students = Student::where('grade_id',$request->grade_id)
            ->Where('class_id',$request->class_id)
            ->Where('section_id' , $request->section_id)
            ->Where('academic_year' , $request->academic_year)
            ->get();
        if($students->count() == 0 ){
            return back()->with(['error_promotion' => __('Students_trans.error_promotion')]);
        }
        try {
            DB::beginTransaction();
            foreach($students as $student) {
                $ids = explode(',', $student->id);

                Student::whereIn('id', $ids)
                    ->update([
                        'grade_id' => $request->new_grade,
                        'class_id' => $request->new_class,
                        'section_id' => $request->new_section,
                        'academic_year' => $request->new_academic_year,
                    ]);

                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->grade_id,
                    'from_class' => $request->class_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->new_grade,
                    'to_class' => $request->new_class,
                    'to_section' => $request->new_section,
                    'from_academic_year' => $request->academic_year,
                    'to_academic_year' => $request->new_academic_year,
                ]);
            }
              DB::commit(); // insert data
            return back()->with(['success1' => trans('messages.success')]);
        }
        catch (\Exception $exception){
             DB::rollback();
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
    public function showPromotions()
    {
        $promotions = Promotion::with('student','fromGrade','fromClass','fromSection','toGrade','toClass','toSection')
            ->whereHas('student', function ($query) {
                $query->whereNull('deleted_at'); // Filter for non-soft-deleted students
            })->paginate(35);
        $grades = Grade::get();
        return view('pages.students.promotion.management',compact('promotions' , 'grades'));
    }
    public function rollbackPromotion($request)
    {
        // promotions were updated
        $promotions = Promotion::where('to_grade', $request->new_grade)
            ->where('to_class', $request->new_class)
            ->where('to_section', $request->new_section)
            ->where('to_academic_year', $request->to_academic_year)
            ->get();
        if($promotions->count() == 0 ){
            return back()->with(['error_promotion' => __('Students_trans.error_promotion')]);
        }
        //dd($promotions);
        try {
        DB::beginTransaction();
            foreach ($promotions as $promotion) {
                $ids = explode(',', $promotion->id);
                Student::where('id', $promotion->student->id)
                    ->update([
                        'grade_id' => $promotion->from_grade,
                        'class_id' => $promotion->from_class,
                        'section_id' => $promotion->from_section,
                        'academic_year' => $promotion->from_academic_year,
                    ]);
                Promotion::whereIn('id', $ids)->delete(); // Delete the new promotions
            }
        DB::commit(); // Commit rollback changes
            return back()->with(['success1' => __('messages.rollback_success')]);
        } catch (\Exception $exception) {
            DB::rollback();
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function rollbackStudentPromotion(Promotion $promotion)
    {
        try {
            DB::beginTransaction();

            Student::where('id', $promotion->student_id)
                ->update([
                    'grade_id' => $promotion->from_grade,
                    'class_id' => $promotion->from_class,
                    'section_id' => $promotion->from_section,
                    'academic_year' => $promotion->from_academic_year,
                ]);
            $promotion->delete();

            DB::commit(); // Commit rollback changes
            return back()->with(['success1' => __('messages.rollback_success')]);
        } catch (\Exception $exception) {
            DB::rollback();
            return back()->withErrors(['error' => $exception->getMessage()]);
        }

    }


}
