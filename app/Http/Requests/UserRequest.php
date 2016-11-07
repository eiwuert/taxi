<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'      => 'required|email|unique:users|min:6|max:255',
            'password'   => 'required|min:6|max:255',
            'social_id'  => 'max:255',
            'login_by'   => 'in:manual,google,facebook',
            'picture'    => 'image|size:512',
        ];
    }
}
