<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            'name'=>'required|max:100',
            'email'=>'required|email|unique:users,email,'.\Admin::getId(),
            'password'=>'required',
            'verify_password'=>'same:password',
            'avatar'=>'image',
        ];
    }
}
