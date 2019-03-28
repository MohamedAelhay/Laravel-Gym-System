<?php

namespace App\Http\Requests\Api;

use App\Session;
use Illuminate\Foundation\Http\FormRequest;

class UserAttendanceRequest extends FormRequest
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
            'attendance_time' => 'required|date_format:H:i',
            'attendance_date'=> 'required|date_format:Y-m-d|before_or_equal:'.$this->session_date,
            'session_id' => 'required|exists:sessions,id'
        ];
    }
}
