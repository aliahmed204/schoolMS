<?php

namespace App\Repositories\fees;

use App\Interfaces\feesRepositoryInterface;
use App\Models\Fee;
use App\Models\Grade;

class feesRepository implements feesRepositoryInterface
{

    public function index()
    {
        $fees = Fee::with('grade','class')->paginate(10);
        $grades = Grade::get();
        return view('pages.fees.index',compact('fees','grades'));
    }

    public function create()
    {
        $grades = Grade::get();
        return view('pages.fees.create',compact('grades'));
    }
    public function store($request)
    {

        try {
            Fee::create([
                'title'        => ['en' => $request->title_en, 'ar' => $request->title_ar],
                'amount'       =>$request->amount,
                'grade_id'     =>$request->grade_id,
                'class_id'     =>$request->class_id,
                'description'  =>$request->description,
                'year'         =>$request->year,
                'fee_type'     =>$request->fee_type,
            ]);
            return redirect()->route('fees.index')->with(['success1' => trans('messages.success')]);
        }
        catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(Fee $fee)
    {
        $grades = Grade::get();
        return view('pages.fees.edit',compact('fee','grades'));

    }
    public function update(fee $fee , $request)
    {
        try {
            $fee->update([
                'title'        => ['en' => $request->title_en, 'ar' => $request->title_ar],
                'amount'       =>$request->amount,
                'grade_id'     =>$request->grade_id,
                'class_id'     =>$request->class_id,
                'description'  =>$request->description,
                'year'         =>$request->year,
                'fee_type'     =>$request->fee_type,
            ]);
            return back()->with(['updated' => trans('messages.updated')]);
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Fee $fee)
    {
        try {
            $fee->delete();
            return back()->with(['deleted'=> trans('messages.Delete')]);
        }
        catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
