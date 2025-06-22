<?php

namespace App\Http\Requests\Category;

use App\Domain\Category\Model\Value\TransactionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetCategoryListRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'transactionType' => ['required', 'string', Rule::in(TransactionType::strToLowerValues())],
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
        ];
    }
}