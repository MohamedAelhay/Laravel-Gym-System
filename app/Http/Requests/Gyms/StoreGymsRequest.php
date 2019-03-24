<?php

namespace App\Http\Requests\Gyms;

use Illuminate\Foundation\Http\FormRequest;

class StoreGymsRequest extends FormRequest
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
        //'name', 'created_at', 'img', 'creator_name', 'city_id'
        return [
            'name'=>"required|Alpha|max:25|min:6",
            'city_id'=>"exists:cities,id",
            'img' => 'required | mimes:jpeg,jpg,png | max:2000'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'This field Can\'t be Empty !',
            'name.max' => 'Name must be less than 25 Character !',
            'name.min' => 'Name must be more than 6 Character !',
            'city_id.exists' => 'City Must Be Exist !',
            'img.required' => 'Image is required',
            'img.mimes' => 'Image Format must be (jpeg,jpg,png)',
            'img.max' => 'Image Max Size is 2000kb'

        ];
    }
}
