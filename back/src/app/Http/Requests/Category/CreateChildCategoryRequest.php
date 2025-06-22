<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateChildCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'transactionType' => ['required', 'string', Rule::in(['expense', 'income'])],
            'categoryName' => ['required', 'string', 'max:50'],
            'parentCategoryId' => ['required', 'integer', 'min:1'],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'transactionType.required' => 'Transaction type is required.',
            'transactionType.in' => 'Transaction type must be either expense or income.',
            'categoryName.required' => 'Category name is required.',
            'categoryName.string' => 'Category name must be a string.',
            'categoryName.max' => 'Category name may not be greater than 50 characters.',
            'parentCategoryId.required' => 'Parent category ID is required.',
            'parentCategoryId.integer' => 'Parent category ID must be an integer.',
            'parentCategoryId.min' => 'Parent category ID must be greater than 0.',
        ];
    }
}