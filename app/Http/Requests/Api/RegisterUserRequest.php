<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:10'
        ];
    }

    public function messages()
    {
        return [
          'name.string' => 'Name Must be Char. Only',
          'email.unique' => 'Your E-mail Already exist',
          'password.min' => 'Your Password must be gt 6 char',
          'password.max' => 'Your Password must be lte 10 char'
        ];
    }
}
