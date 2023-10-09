<?php

namespace App\Http\Requests\OnlineClass;

use Illuminate\Foundation\Http\FormRequest;

class CreateMeetingRequest extends FormRequest
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
            'grade_id'   => 'required|exists:grades,id',
            'class_id'   => 'required|exists:class_rooms,id',
            'section_id' => 'required|exists:sections,id',
            'meeting_id' => 'required',
            'topic'      => 'required',
            'start_at'   => 'required|date',
            'duration'   => 'required|integer',
            'password'   => 'nullable|string',
            'start_url'  => 'required|url',
            'join_url'   => 'required|url',
        ];
    }

    public function attributes()
    {
        return[
            'grade_id'   => trans('onlineClass.Grade'),
            'class_id'   => trans('onlineClass.class'),
            'section_id' => trans('onlineClass.section'),
            'meeting_id' => trans('onlineClass.meeting_id'),
            'topic'      => trans('onlineClass.topic'),
            'start_at'   => trans('onlineClass.start_at'),
            'duration'   => trans('onlineClass.duration'),
            'password'   => trans('onlineClass.password'),
            'start_url'  => trans('onlineClass.start_url'),
            'join_url'   => trans('onlineClass.join_url'),
        ];
    }



}
