<?php

namespace App\Http\Requests\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'email' => 'required|email|unique:teachers,email',
            'password' => 'required|min:8',
            'name_ar' => 'required|min:12|max:55',
            'name_en' => 'required|min:12|max:55',
            'specialization_id' => 'required|numeric',
            'gender_id' => 'required|numeric',
            'joining_date' => 'required|date|date_format:Y-m-d',
            'address' => 'required|max:55',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.email'),
            'email.unique' => trans('validation.unique'),

            'password.required' => trans('validation.required'),
            'password.min' => trans('validation.min'),

            'name_ar.required' => trans('validation.required'),
            'name_ar.min' => trans('validation.min'),
            'name_ar.max' => trans('validation.max'),

            'name_en.required' => trans('validation.required'),
            'name_en.min' => trans('validation.min'),
            'name_en.max' => trans('validation.max'),

            'specialization_id.required' => trans('validation.required'),
            'specialization_id.numeric' => trans('validation.numeric'),

            'gender_id.required' => trans('validation.required'),
            'gender_id.numeric' => trans('validation.numeric'),

            'joining_date.required' => trans('validation.required'),
            'joining_date.date' => trans('validation.date'),

            'address.required' => trans('validation.required'),
            'address.max' => trans('validation.max'),
        ];
    }

    public function attributes()
    {
        return [
            'email'          => trans('Teacher_trans.Email'),
            'password'       => trans('Teacher_trans.Password'),
            'name_ar'        => trans('Teacher_trans.Name_ar'),
            'name_en'        => trans('Teacher_trans.Name_en'),
            'specialization_id'  => trans('Teacher_trans.specialization'),
            'gender_id'      => trans('Teacher_trans.Gender'),
            'joining_date'   => trans('Teacher_trans.Joining_Date'),
            'address'        => trans('Teacher_trans.Address'),
        ];
    }

}
