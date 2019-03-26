<?php

// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;

// class StoreCityManagerRequest extends FormRequest
// {
//     /**
//      * Determine if the user is authorized to make this request.
//      *
//      * @return bool
//      */
//     public function authorize()
//     {
//         return true;
//     }

//     /**
//      * Get the validation rules that apply to the request.
//      *
//      * @return array
//      */
//     public function rules()
//     {
//         return [
//             'national_id'=>'required|digits|min:5|unique:CityManagers,national_id,'.$this->CityManager['id'],
//             'email'=>'required',
//             'name'=>"required|Alpha|max:25|min:6",
//             'password'=>"required|min:6",
//             'img' => 'mimes:jpeg,jpg,png | max:2000'
//         ];
//     }
//     public function messages() 

//     {
//         return[
//         'national_id.required' => 'you must enter your national id',
//         'national_id.digits' => 'must be numbers',
//         'national_id.min' =>'national id must be at least 5',
//         'email.required' => 'you must enter your email',
//         'name.required' => 'you must enter your name',
//         'password' =>'password is required',
//         'img.max' => 'image Max Size is 2000kb',
//         'img.mimes' => 'image extensins must be jpeg or jpg or png'
//         ];
//     }
    


// }