<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // MUST BE TRUE
    }

    /**
     * Validation rules for Store Product
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',

            'name' => 'required|unique:products,name',

            'type' => 'required',
            'look' => 'required',
            'finish' => 'required',

            'size' => 'required',
            'color' => 'required',

            'description' => 'required|min:20',

            'collection' => 'nullable',
            'technical_spec' => 'nullable',

            // Minimum 1 image required only for store()
            'gallery' => 'required',
            'gallery.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
