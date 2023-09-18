<?php

namespace App\Http\Requests\ClassRooms;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'classes_list.*.name' => 'required',
            'classes_list.*.name_ar' => 'required',
            'classes_list.*.grade_id' => 'required|integer',
        ];
    }

    public function massage(){
        return [
            'name.required' => trans('classRooms.required_en'),
            'name_ar.required' => trans('classRooms.required_ar'),

            'grade_id.required' => trans('classRooms.Name_Grade'),
            'grade_id.integer' => trans('classRooms.integer'),
        ];
    }

    public function attributes()
    {
        return [
            'classes_list.*.name' => trans('classRooms.Name_class_en'),
            'classes_list.*.name_ar' => trans('classRooms.Name_class'),
            'classes_list.*.grade_id' => trans('classRooms.Name_Grade'),
        ];
    }
}
