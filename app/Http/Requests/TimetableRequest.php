<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimetableRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name is required',
            'name.string' => 'The name must be a string',
            'name.max' => 'The name must be less than 255 characters',
            'start_time.required' => 'The start time is required',
            'start_time.date_format' => 'The start time must be in the format HH:mm',
            'end_time.required' => 'The end time is required',
            'end_time.date_format' => 'The end time must be in the format HH:mm',
            'end_time.after' => 'The end time must be after the start time',
        ];
    }
}
