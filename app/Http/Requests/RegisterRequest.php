<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'   => 'max:255',
            'last_name'    => 'max:255',
            'sex'          => 'in:male,female,not specified',
            'device_token' => 'max:255',
            'device_type'  => 'max:255',
            'lang'         => 'in:fa,en',
            'phone'        => 'required|integer',
            'picture'      => 'image|max:512',
        ];
    }
}
