<?php

namespace App\Repositories\invoices;

use App\Interfaces\invoiceFeesRepositoryInterface;
use App\Models\Fee;
use App\Models\FeeInvoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class invoiceFeesRepository implements invoiceFeesRepositoryInterface
{

    public function index()
    {
        $invoices = FeeInvoice::paginate();
        $grades = Grade::get();
        return view('pages.students.fees_invoices.index',compact('invoices','grades'));

    }

    public function create($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fee::where('class_id',$student->class_id)->get();
        return view('pages.students.fees_invoices.invoice_create',compact('student','fees'));
    }

    public function store($request)
    {
        $invoice_list = $request->invoice_list;
        DB::beginTransaction();
        try {

            foreach ($invoice_list as $invoice) {
                $fee = FeeInvoice::create([
                    'invoice_date' => date('Y-m-d'),
                    'student_id'   => $invoice['student_id'],
                    'grade_id'     => $request->grade_id,
                    'class_id'     => $request->class_id,
                    'fee_id'       => $invoice['fee_id'],
                    'amount'       =>  $invoice['amount'],
                    'description'  => $invoice['description'],
                ]);
                StudentAccount::create([
                    'student_id'  => $invoice['student_id'],
                    'date'        => date('Y-m-d'),
                    'type'        => 'invoice',
                    'fee_invoices_id' => $fee->id,
                    'debit'       => $invoice['amount'],
                    'credit'      => 0,00,
                    'description' => $invoice['description'],
                ]);
            }
            DB::commit();
            return redirect()->route('feeInvoices.index')->with(['success1' => trans('messages.success')]);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function edit(FeeInvoice $feeInvoice)
    {
        $fees = Fee::where('class_id',$feeInvoice->class_id)->get();
        return view('pages.students.fees_invoices.edit',compact('feeInvoice','fees'));
    }
    public function update(FeeInvoice $feeInvoice , $request)
    {


        DB::beginTransaction();
        try {
            $feeInvoice->update([
                'fee_id'       => $request->fee_id, // fee_type
                'amount'       =>  $request->amount,
                'description'  => $request->description,
            ]);

            $studentAccount = StudentAccount::where('fee_invoices_id',$feeInvoice->id)->first();
            $studentAccount->update([
                'debit'           => $request->amount,
                'description'     =>  $request->description,
            ]);
            DB::commit();
            return redirect()->route('feeInvoices.index')->with(['updated' => trans('messages.updated')]);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy(FeeInvoice $feeInvoice)
    {
        try {
            $feeInvoice->delete();
            return back()->with(['deleted'=> trans('messages.Delete')]);
        }
        catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
