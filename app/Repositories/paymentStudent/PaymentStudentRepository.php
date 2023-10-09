<?php

namespace App\Repositories\paymentStudent;

use App\Interfaces\PaymentStudentRepositoryInterface;
use App\Models\FundAccount;
use App\Models\PaymentStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class PaymentStudentRepository implements PaymentStudentRepositoryInterface
{

    public function index()
    {
        $paymentStudents =  PaymentStudent::with('student')->paginate();
        return view('pages.students.paymentStudent.index',compact('paymentStudents'));
    }

    public function create($id)
    {
        $student = Student::findOrFail($id);
        $amount = $student->studentAccounts->sum('debit') - $student->studentAccounts->sum('credit') ;
        return view('pages.students.paymentStudent.create',compact('student' , 'amount'));
    }

    public function store($request)
    {
        // بعد ما بيتم استباعد مصاريف مثلا خاصة الباص - عاوز اصرف الفلوس اللى هو دفعها خاصة الباص
        // وبعدين اعدل جدول حساب الطالب بالمبلغ اللى خده -- واخرج الفلوس من جدول حساب الصندوق الإيرادات
        DB::beginTransaction();
        try {
            //  جدول سندات الصرف - الطالب هياخد فلوس كان مدفوعة
            $paymentStudent = PaymentStudent::create([
                'date'       => date('Y-m-d'),
                'student_id' => $request->student_id,
                'amount'      => $request->debit,
                'description'=> $request->description,
            ]);
            //  جدول صندوق الإيرادات - هيخرج منه فلوس
            FundAccount::create([
                'date'       => date('Y-m-d'),
                'payment_id' => $paymentStudent->id,
                'debit'      => 0.00 ,
                'credit'     => $request->debit,
                'description'=> $request->description,
            ]);

            //  جدول حساب الطالب - هدفع فلوس للطالب ف هيبقى مدين بالمبلغ اللى خده
            StudentAccount::create([
                'date'        => date('Y-m-d'),
                'type'        => 'Payment',
                'payment_id'  => $paymentStudent->id,
                'student_id'  => $request->student_id,
                'debit'       => $request->debit,
                'credit'      => 0.00 ,
                'description' => $request->description,
            ]);

            DB::commit();                // need editing
            return redirect()->route('paymentStudents.index')->with(['success1' => trans('messages.success')]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(PaymentStudent $paymentStudent)
    {
        return view('pages.students.paymentStudent.edit',compact('paymentStudent'));
    }

    public function update(PaymentStudent $paymentStudent, $request)
    {
        DB::beginTransaction();
        try {
            //  جدول سندات الصرف - الطالب هياخد فلوس كان مدفوعة
            $paymentStudent->update([
                'date'       => date('Y-m-d'),
                'student_id' => $request->student_id,
                'amount'      => $request->debit,
                'description'=> $request->description,
            ]);
            //  جدول صندوق الإيرادات - هيخرج منه فلوس
            $fundAccount= FundAccount::where( 'payment_id' , $paymentStudent->id)->first();
            $fundAccount->update([
                'date'       => date('Y-m-d'),
                'payment_id' => $paymentStudent->id,
                'debit'      => 0.00 ,
                'credit'     => $request->debit,
                'description'=> $request->description,
            ]);
            //  جدول حساب الطالب - هدفع فلوس للطالب ف هيبقى مدين بالمبلغ اللى خده
            $studentAccount= StudentAccount::where( 'payment_id' , $paymentStudent->id)->first();
            $studentAccount->update([
                'date'        => date('Y-m-d'),
                'type'        => 'Payment',
                'payment_id'  => $paymentStudent->id,
                'student_id'  => $request->student_id,
                'debit'       => $request->debit,
                'credit'      => 0.00 ,
                'description' => $request->description,
            ]);

            DB::commit();
            return redirect()->route('paymentStudents.index')->with(['updated' => trans('messages.updated')]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(PaymentStudent $paymentStudent)
    {
        try {
            $paymentStudent->delete();
            return back()->with(['deleted'=> trans('messages.Delete')]);
        }
        catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
