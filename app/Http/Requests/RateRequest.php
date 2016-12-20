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
            'stars' => 'required|numeric|in:1,2,3,4,5',
            'comment' => 'max:5000',
        ];
    }
}
