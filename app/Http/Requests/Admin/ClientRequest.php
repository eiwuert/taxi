<?php

namespace App\Http\Requests\Admin;

use App\Client;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'    => 'sometimes|required|min:2|max:255',
            'last_name'     => 'sometimes|required|min:2|max:255',
            'email'         => [
                            'sometimes',
                            Rule::unique('clients')
                                ->ignore(is_null($client = Client::whereEmail(FormRequest::get('email'))->first())?0:$client->id),
                            'required',
                            'email',
                            ],
            'gender'        => 'sometimes|required|in:"male", "female", "not specified"',
            'address'       => 'sometimes|required|max:255',
            'state'         => 'sometimes|required|max:255',
            'country'       => 'sometimes|required|max:255',
            'zipcode'       => 'sometimes|required|max:255',
            'lang'          => 'sometimes|required|in:fa,en,ku',
            'device_token'  => 'sometimes|required|max:255',
            'device_type'   => 'sometimes|required|in:manual,ios,android',
        ];
    }
}
