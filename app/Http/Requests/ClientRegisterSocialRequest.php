<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ClientRegisterSocialRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'social_id'  => 'required|min:6|max:255|unique:users,social_id',
            'phone'      => 'required|digits_between:9,255|unique:users,phone',
        ];
    }
}
