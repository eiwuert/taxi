<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SocialRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'      => 'required|email|max:255|unique:users',
            'social_id'  => 'required|min:6|max:255',
            'login_by'   => 'required|in:manual,google,facebook',
            'picture'    => 'image|size:512',
        ];
    }
}
