<?php

namespace App\Http\Requests\GymManager;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGymManagerRequest extends FormRequest
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
            'password' => 'required|max:25|min:6',
            'gym_id'=>"exists:gyms,id",
            'img' => 'required | mimes:jpeg,jpg,png | max:2000',
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
            'img.required' => 'Image is required',
            'img.mimes' => 'Image Format must be (jpeg,jpg,png)',
            'img.max' => 'Image Max Size is 2000kb',
            'email.required' => 'Email is Required',
            'email.email' => 'Not valid Email Format',
            'national_id.required' => 'This field Can\'t be Empty !',
            'national_id.max' => 'National Id must be less than 25 Character !',
            'national_id.min' => 'National Id must be more than 6 Character !',
            'password.required' => 'This field Can\'t be Empty !',
            'password.max' => 'password must be less than 25 Character !',
            'password.min' => 'password Id must be more than 6 Character !',

        ];
    }

}
