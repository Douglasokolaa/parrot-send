<?php

namespace App\Http\Requests;

use App\Rules\Delimited;
use Illuminate\Foundation\Http\FormRequest;
use Propaganistas\LaravelPhone\Rules\Phone;

class DirectMessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'sender_id'    => ['required', 'exists:senders,id'],
            'country_code' => ['required', 'string'],
            'numbers'      => ['required', new Delimited((new Phone())->detect()->country($this->input('country_code')))],
            'message'      => ['required', 'max:255'],
            'send_date'    => ['required', 'after_or_equal:now'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'numbers' => explode(',', $this->input('numbers'))
        ]);
    }
}
