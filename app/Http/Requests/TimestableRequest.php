<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimestableRequest extends FormRequest
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
        //    'start_time' => 'required|date_format:H:i|after:08:00|before:20:00',
        //    'end_time' => 'required|date_format:H:i|after:08:00|before:20:00|after:start_time',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ];
    }
}
