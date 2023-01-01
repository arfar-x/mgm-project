<?php

namespace App\Services\ProjectService\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3'],
            'slug' => ['required', 'string', 'min:3'],
            'position' => ['required', 'numeric', 'min:1'],
            'cover' => ['required', 'sometimes', 'string'],
            'status' => ['required', 'sometimes', 'bool'],
            'files' => ['required', 'sometimes', 'array'],
            'files.*' => ['required', 'mimetypes:image/jpeg,image/png,image/webp,image/bmp', 'max:3000'],
        ];
    }
}
