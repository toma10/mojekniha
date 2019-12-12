<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
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
            'original_name' => ['required'],
            'description' => ['required'],
            'release_year' => ['required', 'numeric', 'min:0'],
            'author_id' => ['required', 'exists:authors,id'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,jpg', Rule::dimensions()->minWidth(400)],
        ];
    }
}
