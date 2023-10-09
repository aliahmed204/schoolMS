<?php

namespace App\Repositories;

use App\Interfaces\ReceiptStudentRepositoryInterface;
use App\Models\FundAccount;
use App\Models\ReceiptStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ReceiptStudentRepository implements ReceiptStudentRepositoryInterface
{

    public function index()
    {
        $receipts =  ReceiptStudent::with('student')->paginate();
        return view('pages.students.receipt.index',compact('receipts'));
    }

    public function create($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.students.receipt.create',compact('student'));
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            //  جدول سندات القبض
        $receipt = ReceiptStudent::create([
                'date'       => date('Y-m-d'),
                'student_id' => $request->student_id,
                'debit'      => $request->debit,
                'description'=> $request->description,
            ]);
            //  جدول الصندوق
            FundAccount::create([
                'date'       => date('Y-m-d'),
                'receipt_id' => $receipt->id,
                'debit'      => $request->debit,
                'credit'      => 0.00 ,
                'description'=> $request->description,
            ]);
            //  جدول حساب الطالب
            StudentAccount::create([
                'date'        => date('Y-m-d'),
                'type'        => 'receipt',
                'receipt_id'  => $receipt->id,
                'student_id'  => $request->student_id,
                'debit'       => 0.00 ,
                'credit'      => $request->debit,
                'description' => $request->description,
            ]);
            DB::commit();
            return redirect()->route('receiptStudents.index')->with(['success1' => trans('messages.success')]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(ReceiptStudent $receiptStudent)
    {
        return view('pages.students.receipt.edit',compact('receiptStudent'));
    }

    public function update(ReceiptStudent $receiptStudent ,$request)
    {
        DB::beginTransaction();
        try {
            //  جدول سندات القبض
            $receiptStudent->update([
                'date'       => date('Y-m-d'),
                'student_id' => $receiptStudent->student_id,
                'debit'      => $request->debit,
                'description'=> $request->description,
            ]);
            //  جدول الصندوق
            $fund = FundAccount::where( 'receipt_id' , $receiptStudent->id)->first();
            $fund->update([
                'date'       => date('Y-m-d'),
                'receipt_id' => $receiptStudent->id,
                'debit'      => $request->debit,
                'credit'      => 0.00 ,
                'description'=> $request->description,
            ]);
            //  جدول حساب الطالب
            $account = StudentAccount::where( 'receipt_id' , $receiptStudent->id)->first();
            $account->update([
                'date'        => date('Y-m-d'),
                'type'        => 'receipt',
                'receipt_id'  => $receiptStudent->id,
                'student_id'  => $receiptStudent->student_id,
                'debit'       => 0.00 ,
                'credit'      => $request->debit,
                'description' => $request->description,
            ]);
            DB::commit();
            return redirect()->route('receiptStudents.index')->with(['updated' => trans('messages.updated')]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(ReceiptStudent $receiptStudent)
    {
        try {
            $receiptStudent->delete();
            return back()->with(['deleted'=> trans('messages.Delete')]);
        }
        catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
