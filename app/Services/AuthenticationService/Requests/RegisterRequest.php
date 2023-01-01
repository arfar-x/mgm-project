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
            'username' => ['required', 'sometimes', 'string', 'min:3'],

            // Numbers which start with `+` and any digits in the continuation, or the ones which start with `09` and 9 number of other digits in the continuation.
            'mobile' => ['required', 'string', 'unique:users,mobile', 'regex:/^(\+[0-9][0-9]{1,}|09[0-9]{9})+$/iu'],

            'email' => ['required', 'sometimes', 'email'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'status' => ['required', 'sometimes', 'bool']
        ];
    }
}
