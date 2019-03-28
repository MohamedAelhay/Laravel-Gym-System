<?php

// namespace App\Http\Requests\City;

// use Illuminate\Foundation\Http\FormRequest;

// class StoreCityRequest extends FormRequest
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
//             'name' => 'required|min:3',
//             'city_manager_id' => 'required|exists:city_managers,id',
//             'country_id' => 'required|exists:countries,id'
//         ];
//     }

//     public function messages(){
//         return [
//             'name.required' => 'city name is required',
//             'name.min' => 'name must be more than 3 characters',
//             'city_manager_id.required' => 'city manager id is required',
//             'country_id.required' => 'country id is required'
//         ];
//     }
// }
