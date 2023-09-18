<?php

namespace App\Http\Requests\Sectoins;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
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
            'grade_id' => 'required|integer',
            'class_id' => 'required|integer',
        ];
    }

    public function massage(){
        return [
            'name.required' => trans('sections.required_en'),

            'name_ar.required' => trans('sections.required_ar'),

            'grade_id.required' => trans('sections.Name_Grade'),
            'grade_id.integer' => trans('sections.integer'),

            'class_id.required' => trans('sections.Name_Class'),
            'class_id.integer' => trans('sections.integer'),

        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('sections.Section_name_en'),
            'name_ar' => trans('sections.Section_name_ar'),
            'grade_id' => trans('sections.Name_Grade'),
            'class_id' => trans('sections.Name_Class'),
        ];
    }

}
