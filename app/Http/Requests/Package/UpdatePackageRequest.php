<?php

namespace App\Http\Requests\Package;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
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
            'name'=>"required|Alpha|max:16|unique:gym_packages,name,".$this->package->id,
            'number_of_sessions'=>'required|numeric|min:1',
            'price'=>'required|numeric|min:1',
            'gym_id'=>"required|exists:gyms,id",
        ];
    }
}
