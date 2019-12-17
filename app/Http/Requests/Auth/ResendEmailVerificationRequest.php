<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResendEmailVerificationRequest extends FormRequest
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
            'verify_email_url' => ['required', 'url'],
        ];
    }
}
