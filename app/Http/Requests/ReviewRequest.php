<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request for storing Review.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'comment' => ['required', 'string', 'max:511'],
            'rating' => ['required', 'int', 'min:1', 'max:5'],
        ];
    }

    /**
     * Get custom attributes for validator errors when storing Review.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'comment' => trans('admin/reviews.comment'),
            'rating' => trans('admin/reviews.rating'),
        ];
    }
}
