<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SubcategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request for storing Subcategory.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id_category' => ['int'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom attributes for validator errors when storing Subcategory.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'id_category' => trans('admin/subcategories.idCategory'),
            'name' => trans('admin/subcategories.name'),
            'description' => trans('admin/subcategories.description'),
        ];
    }
}
