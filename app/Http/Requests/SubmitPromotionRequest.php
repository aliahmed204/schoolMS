<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitPromotionRequest extends FormRequest
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
            'grade_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'new_grade' => 'required',
            'new_class' => 'required',
            'new_section' => 'required',
            'academic_year' => 'required',
            'new_academic_year' => 'required',
        ];
    }

    public function massage(){
        return [
            'grade_id.required' => trans('validation.required'),
            'class_id.required' => trans('validation.required'),
            'section_id.required' => trans('validation.required'),
            'academic_year.required' => trans('validation.required'),

            'new_grade.required'  => trans('validation.required'),
            'new_class.integer'   => trans('validation.required'),
            'new_section.integer' => trans('validation.required'),
            'new_academic_year.integer' => trans('validation.required'),

        ];
    }

    public function attributes()
    {
        return [
            'grade_id'    => trans('Students_trans.from_grade'),
            'class_id'    => trans('Students_trans.from_class'),
            'section_id'  => trans('Students_trans.from_section'),
            'academic_year'  => trans('Students_trans.academic_year'),
            'new_grade'      => trans('Students_trans.to_grade'),
            'new_class'      => trans('Students_trans.to_class'),
            'new_section'    => trans('Students_trans.to_section'),
            'new_academic_year'    => trans('Students_trans.new_academic_year'),
        ];
    }
}
