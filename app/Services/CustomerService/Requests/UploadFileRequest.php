<?php

namespace App\Services\CustomerService\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
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
            'title' => ['required', 'sometimes', 'string'],
            'type' => ['required', 'sometimes', 'string'],
            'meta' => ['required', 'sometimes', 'string'],
            'files' => ['required', 'sometimes', 'array'],
            'files.*' => ['required', 'mimetypes:image/jpeg,image/png,image/webp,image/bmp', 'max:3000']
        ];
    }
}
