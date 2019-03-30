<?php

namespace App\Http\Requests\CityManagers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityManagerRequest extends FormRequest
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
            'name' => "Alpha|min:6|max:25",
            'email' => 'email',
            'password' => "min:6",
            // 'national_id' => 'numerm,ic|min:5|unique:city_managers',
            // 'img' => 'mimes:jpeg,jpg,png | max:2000'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be more than 6 Character !',
            'name.max' => 'Name must be less than 25 character',

            'email.required' => 'you must enter your email',
            'email.email' => 'please enter a valid email',

            'password' => 'password is required',
            'password.min' => 'password must be at least 6 characters',

            'national_id.required' => 'you must enter your national id',
            'national_id.digits' => 'must be numbers',
            'national_id.min' => 'national id must be at least 5',

            // 'password' =>'password is required',
            // 'password.min'=>'password must be at least 6 characters',
            // 'img.max' => 'image Max Size is 2000kb',
            // 'img.mimes' => 'image extensins must be jpeg or jpg or png'
        ];
    }
}
