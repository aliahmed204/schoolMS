<?php

namespace App\Http\Requests\Grades;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradesRequest extends FormRequest
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
            'name' => 'required',
            'name_ar' => 'required',
            'notes' => 'required',
        ];
    }

    public function massage(){
        return [
            'name.required' => trans('validation.required'),
            'name_ar.required' => trans('validation.required'),
            'notes.required' => trans('validation.required'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('grades.grade_name_en'),
            'name_ar' => trans('grades.grade_name_ar'),
            'notes' => trans('grades.Notes'),
        ];
    }
}
