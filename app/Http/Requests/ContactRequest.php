<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    public function rules(): array
    {
        return  [
            'first_name'    => ['required', 'max:256'],
            'last_name'     => ['required', 'max:256'],
            'phone_country' => ['required', 'string', 'max:2'],
            'phone'         => ['required', Rule::phone()->countryField('phone_country')->detect()],
            'email'         => ['present', 'nullable', 'email', 'max:256'],
            'address'       => ['present', 'nullable', 'string', 'max:256'],
            'city'          => ['present', 'nullable', 'string', 'max:256'],
            'unit'          => ['present', 'nullable', 'string', 'max:256'],
            'lga'           => ['present', 'nullable', 'string', 'max:256'],
            'state'         => ['present', 'nullable', 'string', 'max:256'],
            'region'        => ['present', 'nullable', 'string', 'max:256'],
            'country'       => ['present', 'nullable', 'string', 'max:256'],
            'business'      => ['present', 'nullable', 'string', 'max:256'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
