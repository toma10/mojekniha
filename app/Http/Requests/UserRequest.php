<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => ['required'],
            'username' => ['required', Rule::unique('users')->ignore($this->user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id)],
        ];
    }
}
