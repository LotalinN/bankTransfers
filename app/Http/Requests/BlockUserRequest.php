<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlockUserRequest extends FormRequest
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
            'is_blocked' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return[
          'is_blocked.required' => 'is_blocked нужно заполнить',
          'is_blocked.boolean' => 'is_blocked должно быть '  
        ];
    }
}
