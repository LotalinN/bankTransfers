<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBankAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bank_id' => 'required|exists:banks,id',
            'account_number' => 'required|string|unique:bank_accounts',
        ];
    }

    public function messages(): array
    {
        return [
            'bank_id.required' => 'bank_id обязательно для заполнения.',
            'bank_id.exists' => 'Банка не существует.',
            'account_number.required' => 'account_number нужно заполнить.',
            'account_number.unique' => 'Такой счет уже зарезервирован.',
        ];
    }
}
