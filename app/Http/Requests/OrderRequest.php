<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'quantity_id' => 'required|exists:quantities,id',
            'box_id' => 'required|exists:boxes,id',
            'delivery_id' => 'required|exists:deliveries,id',
            'delivered_by' => 'required|date',
            'write_on_box' => 'nullable|string',
        ];
    }
}
