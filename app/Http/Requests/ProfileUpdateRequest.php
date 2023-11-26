<?php

namespace App\Http\Requests;

use App\Models\Admin\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['required', 'int', 'regex:/^[0-9]{10,14}$/'],
        ];
    }

    /**
     * Get custom attributes for validator errors when storing User.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => trans('admin/admins.name'),
            'surname' => trans('admin/admins.surname'),
            'email' => trans('admin/admins.email'),
            'phone' => trans('admin/admins.phone'),
        ];
    }
}
