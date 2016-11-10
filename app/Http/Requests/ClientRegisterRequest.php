<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ClientRegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lang'         => 'required|in:fa,en,ar',
            'device_type'  => 'required|max:255',
            'device_token' => 'required|max:255',
            'login_by'     => 'required|in:manual,google,facebook',
        ];
    }
}
