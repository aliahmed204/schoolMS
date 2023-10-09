<?php

namespace App\Http\Requests\library;

use App\Models\library;
use Illuminate\Foundation\Http\FormRequest;

class LibraryStoreRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            return array_merge(library::$rules,
                ['file_name' => 'required|mimes:pdf']
            );
        }elseif($this->isMethod('PATCH')){
            return array_merge(library::$rules,
                ['file_name' => 'nullable|mimes:pdf']
            );
        }
    }

    public function attributes(): array
    {
        return [
            'title'      => trans('library.title'),
            'teacher_id' => trans('exam.teacher'),
            'grade_id'   => trans('Students_trans.Grade'),
            'class_id'   => trans('Students_trans.classrooms'),
            'section_id' => trans('Students_trans.section'),
            'file_name'  => trans('library.attach')
        ];
    }


}
