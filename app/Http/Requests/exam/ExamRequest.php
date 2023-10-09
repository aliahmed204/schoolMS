<?php

namespace App\Http\Requests\exam;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            'name_en'       => 'required|string',
            'name_ar'       => 'required|string',
            'term'          => 'required|numeric|max:3',
            'academic_year' => 'required|numeric',
        ];
    }

    public function attributes(): array
    {
        return [
            'name_ar' => trans('exam.exam_name_ar'),
            'name_en' => trans('exam.exam_name_en'),
            'term' => trans('exam.term'),
            'academic_year' => trans('exam.year'),
        ];
    }

}
