<?php

namespace App\Http\Requests\Session;

use App\Rules\Overlapping;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSessionRequest extends FormRequest
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
        $starts_at = $this->starts_at;
        $finishes_at = $this->finishes_at;
        $date = $this->session_date;
        return [
            //
            'session_date' => 'required|',
            'starts_at' => 'required|',
            'finishes_at' => ['required', 'different:starts_at', 'after:starts_at', new Overlapping($starts_at, $finishes_at, $date)],
        ];
    }

    public function messages()
    {
        return [
            'finishes_at.after' => 'End time must be after Start time!',
        ];
    }
}
