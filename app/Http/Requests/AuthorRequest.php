<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthorRequest extends FormRequest
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
            'birth_date' => ['required', 'date'],
            'death_date' => ['nullable', 'date'],
            'biography' => ['nullable', 'string'],
            'nationality_id' => ['required', 'integer', 'exists:nationalities,id'],
            'portrait_image' => ['nullable', 'image', 'mimes:jpeg,jpg', Rule::dimensions()->minWidth(400)],
        ];
    }
}
