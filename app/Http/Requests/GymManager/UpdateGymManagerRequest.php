<?php

namespace App\Http\Requests\GymManager;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGymManagerRequest extends FormRequest
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
            'name'=>"required|Alpha|max:25|min:6",
            'email' => "required|email",
            'password' => 'max:25|min:6',
            'gym_id'=>"exists:gyms,id",
            'img' => 'mimes:jpeg,jpg,png | max:2000',
            'national_id' => 'required|max:25|min:6',
        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'This field Can\'t be Empty !',
            'name.max' => 'Name must be less than 25 Character !',
            'name.min' => 'Name must be more than 6 Character !',
            'gym_id.exists' => 'Gym Must Be Exist !',
            'img.mimes' => 'Image Format must be (jpeg,jpg,png)',
            'img.max' => 'Image Max Size is 2000kb',
            'email.required' => 'Email is Required',
            'email.email' => 'Not valid Email Format',
            'national_id.required' => 'This field Can\'t be Empty !',
            'password.max' => 'password must be less than 25 Character !',
            'password.min' => 'password Id must be more than 6 Character !',

        ];
    }
}
