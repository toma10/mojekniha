<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ForgotPasswordRequest extends FormRequest
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
            'reset_password_url' => [Rule::requiredIf(! $this->isRequestFromAdminArea()), 'url'],
        ];
    }

    protected function isRequestFromAdminArea(): bool
    {
        return $this->route()->getName() === 'admin.auth.password.email';
    }
}
