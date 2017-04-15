<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        $data = $validator->getMessageBag()->toArray();
        $data['title'] = __('api/validation.Validation failed');
        $data['detail'] = __('api/validation.Validation for given fields have been failed, please check your inputs');
        $data['status'] = 422;
        return [
            "success" => false,
            "data" => [$data]
        ];
    }
}
