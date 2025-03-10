<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'from_account' => 'required|exists:bank_accounts,id',
            'to_account' => 'required|exists:bank_accounts,id',
            'amount' => 'required|numeric|min:0.01',
            'comment' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'from_account.required' => 'from_account обязательно для заполнения.',
            'from_account.exists' => 'Счета не существует.',
            'to_account.required' => 'Поле to_account обязательно для заполнения.',
            'to_account.exists' => 'счет получателя не существует.',
            'amount.required' => 'amount обязательно для заполнения.',
            'amount.numeric' => 'amount должно быть числом.',
            'amount.min' => 'Минимальная сумма для перевода должна быть от 0.01.',
            'comment.string' => 'comment должно быть строкой(string).',
        ];
    }
}
