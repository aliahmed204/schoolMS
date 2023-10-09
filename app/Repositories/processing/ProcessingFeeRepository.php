<?php

namespace App\Repositories\processing;

use App\Interfaces\ProcessingFeeRepositoryInterface;
use App\Models\FundAccount;
use App\Models\ProcessingFee;
use App\Models\ReceiptStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{

    public function index()
    {
        $processingFees =  ProcessingFee::with('student')->paginate();
        return view('pages.students.processingFee.index',compact('processingFees'));
    }

    public function create($id)
    {
        $student = Student::findOrFail($id);
        $amount = $student->studentAccounts->sum('debit') - $student->studentAccounts->sum('credit') ;
        return view('pages.students.processingFee.create',compact('student' , 'amount'));
    }

    public function store( $request)
    {
        DB::beginTransaction();
        try {
            //  جدول معالجة الحساب - تصفية حساب طالب مغادر
            $processingFee = ProcessingFee::create([
                'date'       => date('Y-m-d'),
                'student_id' => $request->student_id,
                'amount'      => $request->debit,
                'description'=> $request->description,
            ]);
            //  جدول حساب الطالب
            StudentAccount::create([
                'date'        => date('Y-m-d'),
                'type'        => 'ProcessingFee',
                'processing_fees_id'  => $processingFee->id,
                'student_id'  => $request->student_id,
                'debit'       => 0.00 ,
                'credit'      => $request->debit,
                'description' => $request->description,
            ]);
            DB::commit();
            return redirect()->route('processingFees.index')->with(['success1' => trans('messages.success')]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(ProcessingFee $processingFee)
    {
        return view('pages.students.processingFee.edit',compact('processingFee'));
    }

    public function update(ProcessingFee $processingFee, $request)
    {
        DB::beginTransaction();
        try {
            $processingFee->update([
                'date'       => date('Y-m-d'),
                'student_id' => $request->student_id,
                'amount'      => $request->debit,
                'description'=> $request->description,
            ]);
            $studentAccount= StudentAccount::where( 'processing_fees_id' , $processingFee->id)->first();
            //  جدول حساب الطالب
            $studentAccount->update([
                'date'        => date('Y-m-d'),
                'type'        => 'ProcessingFee',
                'processing_fees_id'  => $processingFee->id,
                'student_id'  => $request->student_id,
                'debit'       => 0.00 ,
                'credit'      => $request->debit,
                'description' => $request->description,
            ]);
            DB::commit();
            return redirect()->route('processingFees.index')->with(['updated' => trans('messages.updated')]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(ProcessingFee $processingFee)
    {
        try {
            $processingFee->delete();
            return back()->with(['deleted'=> trans('messages.Delete')]);
        }
        catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
