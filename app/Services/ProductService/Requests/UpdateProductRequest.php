<?php

namespace App\Services\ProductService\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'title' => ['required', 'sometimes', 'string', 'min:3'],
            'slug' => ['required', 'sometimes', 'string', 'min:3'],
            'body' => ['required', 'sometimes', 'string'],
            'attributes' => ['required', 'sometimes', 'array'],
            'attributes.*' => ['required', 'array'],
            'attributes.*.*' => ['required', 'string']
        ];
    }
}