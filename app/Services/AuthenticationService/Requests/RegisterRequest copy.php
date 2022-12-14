<?php

namespace App\Services\AuthenticationService\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:3'],
            'last_name' => ['required', 'string', 'min:3'],
            'username' => ['required', 'string', 'min:3', 'unique:users,username'],

            // Numbers which start with '+' and any digits in the continuation, or the ones which start with '09' and 9 number of other digits in the continuation.
            'phone_number' => ['required', 'sometimes', 'string', 'unique:users,phone_number', 'regex:/^(\+[0-9][0-9]{1,}|09[0-9]{9})+$/iu'],

            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ];
    }
}