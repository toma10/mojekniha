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
        $rules = [
            'name' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email'],
        ];

        if ($this->user) {
            $rules['username'][] = Rule::unique('users')->ignore($this->user->id);
            $rules['email'][] = Rule::unique('users')->ignore($this->user->id);
        } else {
            $rules['username'][] = Rule::unique('users');
            $rules['email'][] = Rule::unique('users');
        }

        return $rules;
    }
}
