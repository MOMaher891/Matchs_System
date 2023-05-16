<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStadium extends FormRequest
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
            'name'=>'required',
            'description'=>'required',
            'price'=>'required|numeric',
            'phone'=>'required|min:11|unique:stadiums,phone',
            'admin_id'=>'required',
            'lat'=>'required',
            'long'=>'required',
            // 'image'=>'req'
            //
        ];
    }
}
