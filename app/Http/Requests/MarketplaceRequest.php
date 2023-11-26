<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MarketplaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request for storing Marketplace.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'country_code' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom attributes for validator errors when storing Marketplace.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'country_code' => trans('admin/marketplaces.countryCode'),
            'country' => trans('admin/marketplaces.country'),
            'currency' => trans('admin/marketplaces.currency'),
        ];
    }
}
