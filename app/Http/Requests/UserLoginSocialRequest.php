<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserLoginSocialRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'social_id'    => 'required|min:6|max:255|exists:users,social_id',
        ];
    }
}
