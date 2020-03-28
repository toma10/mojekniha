<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;

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
            'password' => ['min:8', 'confirmed'],
            'token' => [Rule::requiredIf($this->isRequestFromAdminArea()), 'string'],
        ];
    }

    protected function isRequestFromAdminArea(): bool
    {
        $route = $this->route();

        if (! $route instanceof Route) {
            return false;
        }

        return $route->getName() === 'admin.auth.password.update';
    }
}
