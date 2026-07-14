<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Email;

class AuthRequest extends FormRequest
{

    /**
     * @return array{email: string, password: string}
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    /**
     * @return array{email.required: string, password.required: string}
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Поле обязательно',
            'password.required' => 'Поле обязательно'
        ];
    }
}
