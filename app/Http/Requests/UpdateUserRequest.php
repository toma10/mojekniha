<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $user = $this->user
            ? $this->user
            : $this->user();

        return [
            'name' => ['required'],
            'username' => ['required', Rule::unique('users')->ignore($user->id)],
        ];
    }
}
