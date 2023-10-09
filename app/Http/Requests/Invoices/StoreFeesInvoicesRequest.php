<?php

namespace App\Http\Requests\Invoices;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeesInvoicesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'invoice_list' => 'required|array',
            'invoice_list.*.student_id' => 'required|exists:students,id',
            'invoice_list.*.fee_id' => 'required|exists:fees,id',
            'invoice_list.*.amount' => 'required|numeric|min:0',
            'invoice_list.*.description' => 'nullable|string',
            'grade_id' => 'required|exists:grades,id',
            'class_id' => 'required|exists:class_rooms,id',
        ];
    }

    public function attributes()
    {
        return [
            'invoice_list.*.student_id' =>  trans('invoice.student'),
            'invoice_list.*.fee_id'     =>  trans('invoice.fee_type'),
            'invoice_list.*.amount'     =>  trans('invoice.amount'),
            'invoice_list.*.description'  =>  trans('invoice.description'),
            'grade_id'                 =>  trans('invoice.grade'),
            'class_id'                 =>  trans('invoice.class'),
        ];
    }

}
