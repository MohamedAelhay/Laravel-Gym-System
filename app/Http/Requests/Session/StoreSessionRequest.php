<?php

namespace App\Http\Requests\Session;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
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
            //
            'name' => 'required|min:3',
            'gym_id' => 'required|exists:gyms,id',
            'coach_id'=>'required|exists:coaches,id',
            'starts_at' => 'required|',
            'finishes_at' => 'required|after:starts_at',
            'session_date' => 'required|',
        ];
    }

    public function messages()
    {
        return [
            'finishes_at.after' => 'End time must be after Start time!',        
        ];
    }
}
