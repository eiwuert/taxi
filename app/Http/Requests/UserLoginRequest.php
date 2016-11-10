<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserLoginRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password'     => 'required|min:6|max:255',
            'phone'        => 'required|digits_between:9,255|exists:users,phone',
        ];
    }
}
