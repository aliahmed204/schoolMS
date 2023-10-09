<?php

namespace App\Http\Requests\receipt;

use Illuminate\Foundation\Http\FormRequest;

class ManageReceiptRequest extends FormRequest
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
            'student_id' => 'required|exists:students,id',
            'debit' => 'required|numeric',
            'description' => 'required|string',
        ];
    }

    public function attributes()
    {
      return  [
        'debit'      => trans('receipt.debit'),
        'description'=> trans('receipt.description'),
        'student_id'=> trans('receipt.student'),
      ];
    }
}
