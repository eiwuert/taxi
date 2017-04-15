<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone'        => 'required|numeric|sizeOfPhone',
            'login_by'     => 'required|in:manual,facebook,google',
        ];
    }
}
