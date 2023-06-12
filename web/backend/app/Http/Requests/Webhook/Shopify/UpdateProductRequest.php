<?php

namespace App\Http\Requests\Webhook\Shopify;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'id' => 'required|integer',
            'product_type' => 'required|string',
            'handle' => 'required|string',
            'title' => 'required|string',
            'variants' => 'required|array',
            'variants.*.price' => 'required|string',
            'status' => 'required|string'
        ];
    }
}
