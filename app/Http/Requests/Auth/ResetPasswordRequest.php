<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<array<string>>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'reset_password_url' => ['required_without:token', 'url'],
            'token' => ['required_without:reset_password_url'],
            'password' => ['required_with:token', 'min:8', 'confirmed'],
        ];
    }
}
