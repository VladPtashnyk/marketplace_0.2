<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request for storing Client.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'surname' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'int', 'regex:/^[0-9]{10,14}$/'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ];
    }

    /**
     * Get custom attributes for validator errors when storing Client.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => trans('site_profile.name'),
            'surname' => trans('site_profile.surname'),
            'email' => trans('site_profile.email'),
            'phone' => trans('site_profile.phone'),
            'password' => trans('site_profile.password'),
        ];
    }
}
