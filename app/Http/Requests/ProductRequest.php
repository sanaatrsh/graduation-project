<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id|max:255',
            'brand_id' => 'required|exists:brands,id|max:255',
            'description' => 'nullable',
            'trending' => 'nullable|boolean',
            'price' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'file|mimes:png,jpg,jpeg',

            //offer
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'start_date' => 'nullable|date|after_or_equal:today',
            'end_date' => 'nullable|date|after:start_date',
        ];
    }
}
