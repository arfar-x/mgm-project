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
            'category_id' => ['required', 'sometimes', 'numeric', 'min:0'],
            'title' => ['required', 'sometimes', 'string', 'min:3'],
            'slug' => ['required', 'sometimes', 'string', 'min:3'],
            'body' => ['required', 'sometimes', 'string'],
            'files' => ['required', 'sometimes', 'array'],
            'files.*' => ['required', 'mimetypes:image/jpeg,image/png,image/webp,image/bmp', 'max:3000'],
            'attributes' => ['required', 'sometimes', 'array'],
            'attributes.*' => ['required', 'array'],
            'attributes.*.*' => ['required', 'string']
        ];
    }
}