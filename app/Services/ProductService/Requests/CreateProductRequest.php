<?php

namespace App\Services\ProductService\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            // TODO Incomplete
            'title' => ['required', 'sometimes', 'string'],
            'slug' => ['required', 'sometimes', 'string'],
            'files' => ['required', 'sometimes', 'array'],
            'files.*' => ['required', 'mimetypes:image/jpeg,image/png,image/webp,image/bmp', 'max:3000']
        ];
    }
}