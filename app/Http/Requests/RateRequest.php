<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stars' => 'required|min:1|max:5',
        ];
    }
}
