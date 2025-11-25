<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',

            'name' => 'required|unique:products,name,' . $this->product->id,

            'type' => 'required',
            'look' => 'required',
            'finish' => 'required',

            'size' => 'required',
            'color' => 'required',

            'description' => 'required|min:20',

            'collection' => 'nullable',
            'technical_spec' => 'nullable',

            // update me gallery optional
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
