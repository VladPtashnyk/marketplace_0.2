<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProducerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request for storing Producer.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'contacts' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom attributes for validator errors when storing Producer.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => trans('admin/producers.name'),
            'address' => trans('admin/producers.address'),
            'contacts' => trans('admin/producers.contacts'),
        ];
    }
}
