<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DriverRegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lang'         => 'required|in:fa,en',
            'state'        => 'required|max:255|in:' . implode(', ', range(1, 32)),
            'country'      => 'required|max:255',
            'device_type'  => 'required|max:255',
            'device_token' => 'required|max:255',
        ];
    }
}
