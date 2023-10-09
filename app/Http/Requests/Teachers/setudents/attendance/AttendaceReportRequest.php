<?php

namespace App\Http\Requests\Teachers\setudents\attendance;

use Illuminate\Foundation\Http\FormRequest;

class AttendaceReportRequest extends FormRequest
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
            'student_id' => 'nullable|integer',
            'from' => 'required|date|date_format:Y-m-d|before_or_equal:to',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ];
    }
    public function messages() : array
    {
        return [
            'student_id.integer'    => 'رقم تعريف الطالب يجب ان يكون رقم',
            'to.after_or_equal'    => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
            'from.before_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
            'from.date_format'     => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format'       => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ];
    }
    public function attributes(): array
    {
        return [
            'student_id' => trans('invoice.student'),
            'from' => trans('invoice.student'),
            'to' => trans('invoice.student')
        ];
    }


}
