<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRrquest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'product_id' => 'required|exists:products,id',
            'box_id' => 'required|exists:boxes,id',
            'delivery_id' => 'required|exists:deliveries,id',
            'deliverd_by' => 'required|date',
            'write_on_box' => 'nullable|string',
        ];
    }
}
