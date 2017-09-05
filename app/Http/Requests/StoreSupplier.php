<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// Author: Nwe Ni Ei Kyaw 
class StoreSupplier extends FormRequest
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
        //'company_name'  => 'required',
        'suppliername'  => 'required|min:2',
        'email'   => 'required|email|unique:suppliers',
        'phoneno' => 'required|regex:/[0-9]{6}/',
        //'address' => 'required',
        //'tax'     => 'numeric|min:0|max:100',
        ];
    }
}
