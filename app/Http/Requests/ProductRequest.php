<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * Get the validation rules that apply to the request for storing Product.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id_producer' => ['int'],
            'id_category' => ['int'],
            'id_subcategory' => ['int'],
            'id_seller' => ['int'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:511'],
            'price' => ['required', 'int'],
            'amount' => ['int'],
        ];
    }

    /**
     * Get custom attributes for validator errors when storing Product.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => trans('products.name'),
            'description' => trans('products.description'),
            'price' => trans('products.price'),
            'amount' => trans('products.amount'),
        ];
    }
}
