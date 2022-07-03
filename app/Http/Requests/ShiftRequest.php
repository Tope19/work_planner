<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShiftRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'worker_id' => 'required|integer|exists:workers,id',
            'timetable_id' => 'required|integer|exists:timetables,id',
        ];
    }

    public function messages()
    {
        return [
            'worker_id.required' => 'The worker id field is required.',
            'worker_id.integer' => 'The worker id must be an integer.',
            'worker_id.exists' => 'The worker id must exist in the workers table.',
            'timetable_id.required' => 'The timetable id field is required.',
            'timetable_id.integer' => 'The timetable id must be an integer.',
            'timetable_id.exists' => 'The timetable id must exist in the timetables table.',
        ];
    }
}
