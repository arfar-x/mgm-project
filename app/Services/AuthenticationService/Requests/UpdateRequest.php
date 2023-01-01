<?php

namespace App\Services\AuthenticationService\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'first_name' => ['required', 'sometimes', 'string', 'min:3'],
            'last_name' => ['required', 'sometimes', 'string', 'min:3'],
            'username' => ['required', 'sometimes', 'string', 'unique:users,username'],
            'email' => ['required', 'email', 'sometimes']
        ];
    }
}
