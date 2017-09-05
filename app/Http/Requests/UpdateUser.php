<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use Illuminate\Http\Request;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //$user = User::findOrFail($user_id = $this->route()->getParameter('users'));
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = User::find($this->users);
        return [
            //
             'name'  => 'required|min:4',
             //'email'=>'required|email|unique:users,email,'. Request::get('id'),
             'email'  => 'required|email',
             //'password'  => 'required|min:4|confirmed'            
        ];
    }
}
