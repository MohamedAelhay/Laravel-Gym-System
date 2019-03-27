<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string',
            'password' => 'confirmed|string|min:6|max:10',
            'password_confirmation' =>'',
            'img' => 'required|mimes:jpeg,bmp,png|image',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'gender' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Name Must be Char. Only',
            'email.same' => 'You can not Change Your E-mail',
            'password.min' => 'Your Password must be gt 6 char',
            'password.max' => 'Your Password must be lte 10 char',
            'date_of_bith.date_format' => 'date format must be Y-M-D'
        ];
    }
}
