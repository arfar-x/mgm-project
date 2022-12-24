<?php

namespace App\Services\ProductService\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3'],
            'slug' => ['required', 'string', 'min:3'],
            'position' => ['required', 'numeric', 'min:1'],
            'cover' => ['required', 'sometimes', 'string'],
        ];
    }
}
