<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'name'          => 'required',
            'code'          => 'required|unique:products',
            'purchase_price'=> 'required|numeric|min:0',
            'retail_price'  => 'required|numeric|min:0',
            'quantity'      => 'required|numeric|min:1',            
            'category_id'   => 'required',
            'photo'         => 'image',
        ];
    }
}
