<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SmsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|digits:5',
        ];
    }
}
