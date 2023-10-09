<?php

namespace App\Http\Requests\subject;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
            'name_en' => 'required',
            'name_ar' => 'required',
            'grade_id' => 'required|exists:grades,id',
            'class_id' => 'required|exists:class_rooms,id',
            'teacher_id' => 'required|exists:teachers,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'name_en' => trans('subject.subject_name_ar'),
            'name_ar' => trans('subject.subject_name_en'),
            'grade_id' => trans('subject.grade'),
            'class_id' => trans('subject.class'),
            'teacher_id' => trans('subject.teacher'),
        ];
    }

}
