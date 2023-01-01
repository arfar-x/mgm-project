<?php

namespace App\Services\AuthenticationService\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'mobile' => ['required', 'sometimes', 'string', 'regex:/^(\+[0-9][0-9]{1,}|09[0-9]{9})+$/iu'],
            'username' => ['required_without:mobile', 'string', 'min:3',],
            'password' => ['required', 'string', 'min:3'],
            'status' => ['required', 'sometimes', 'bool']
        ];
    }
}
