<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge([
            'email' => 'required|email|unique:students,email,'.$this->student->id,
            'password' => 'nullable|min:8|max:15',
            ],Student::$rules);
    }

    public function messages()
    {
        return [
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.email'),
            'email.unique' => trans('validation.unique'),

            'password.min' => trans('validation.min'),
            'password.max' => trans('validation.max'),

            'name_ar.required' => trans('validation.required'),
            'name_ar.min' => trans('validation.min'),
            'name_ar.max' => trans('validation.max'),

            'name_en.required' => trans('validation.required'),
            'name_en.min' => trans('validation.min'),
            'name_en.max' => trans('validation.max'),

            'gender_id.required' => trans('validation.required'),
            'gender_id.numeric' => trans('validation.numeric'),

            'nationality_id.required' => trans('validation.required'),
            'nationality_id.numeric' => trans('validation.numeric'),

            'blood_id.required' => trans('validation.required'),
            'blood_id.numeric' => trans('validation.numeric'),

            'grade_id.required' => trans('validation.required'),
            'grade_id.numeric' => trans('validation.required'),

            'class_id.required' => trans('validation.numeric'),
            'class_id.numeric' => trans('validation.numeric'),

            'section_id.required' => trans('validation.numeric'),
            'section_id.numeric' => trans('validation.numeric'),

            'parent_id.required' => trans('validation.numeric'),
            'parent_id.numeric' => trans('validation.numeric'),

            'academic_year.required' => trans('validation.numeric'),
            'academic_year.string' => trans('validation.numeric'),

            'joining_date.required' => trans('validation.required'),
            'joining_date.date' => trans('validation.date'),
        ];
    }

    public function attributes()
    {
        return [
            'email'          => trans('Students_trans.email'),
            'password'       => trans('Students_trans.password'),
            'name_ar'        => trans('Students_trans.name_ar'),
            'name_en'        => trans('Students_trans.name_en'),
            'gender_id'      => trans('Students_trans.gender'),
            'nationality_id' => trans('Students_trans.Nationality'),
            'blood_id'       => trans('Students_trans.blood_type'),
            'grade_id'       => trans('Students_trans.Grade'),
            'class_id'       => trans('Students_trans.classrooms'),
            'section_id'     => trans('Students_trans.section'),
            'parent_id'      => trans('Students_trans.parent'),
            'academic_year'  => trans('Students_trans.academic_year'),
            'date_of_birth'  => trans('Students_trans.Date_of_Birth'),
        ];
    }
}
