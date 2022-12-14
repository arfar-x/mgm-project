<?php

namespace App\Services\ContactService\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'caption' => ['required', 'string', 'min:10'],
            'sender_name' => ['required', 'string', 'min:3'],
            'sender_mobile' => ['required', 'sometimes', 'string', 'regex:/^(\+[0-9][0-9]{1,}|09[0-9]{9})+$/iu'],
            'sender_email' => ['required', 'email'],
            'body' => ['required', 'string', 'min:10'],
            'channel' => ['required', 'string'],
            'type' => ['required', 'string'],
        ];
    }
}