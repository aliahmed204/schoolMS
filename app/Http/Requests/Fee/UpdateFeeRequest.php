<?php

namespace App\Http\Requests\Fee;

use App\Models\Fee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFeeRequest extends FormRequest
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
        return array_merge( Fee::$rules ,[
            'class_id' => [ 'required','integer',
                Rule::unique('fees')->where(function ($query) {
                    return $query->where('year', $this->year)
                        ->where('fee_type', $this->fee_type);
                })->ignore($this->route('fee')),
            ],
        ]);
    }

    public function attributes()
    {
        return [
            'title_ar'  => trans('fees.fees_ar'),
            'title_en'  => trans('fees.fees_en'),
            'grade_id'  => trans('fees.grade'),
            'class_id'  => trans('fees.class'),
            'amount'    => trans('fees.amount'),
            'description' => trans('fees.description'),
            'year'      => trans('fees.year'),
            'fee_type'      => trans('fees.fee_type'),
        ];
    }
}
