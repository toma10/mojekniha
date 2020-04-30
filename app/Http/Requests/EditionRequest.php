<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditionRequest extends FormRequest
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
            'book_id' => ['required', 'integer', 'exists:books,id'],
            'isbn' => ['required'],
            'release_year' => ['required', 'integer', 'min:0'],
            'language_id' => ['required', 'integer', 'exists:languages,id'],
            'number_of_pages' => ['required', 'integer', 'min:0'],
            'number_of_copies' => ['required', 'integer', 'min:0'],
            'book_binding_id' => ['required', 'integer', 'exists:book_bindings,id'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,jpg', Rule::dimensions()->minWidth(400)],
        ];
    }

    /**
     * @return array<array<string, mixed>>
     */
    public function validated(): array
    {
        return transform(parent::validated(), function ($data) {
            $data['book_id'] = (int) $data['book_id'];
            $data['release_year'] = (int) $data['release_year'];
            $data['language_id'] = (int) $data['language_id'];
            $data['number_of_pages'] = (int) $data['number_of_pages'];
            $data['number_of_copies'] = (int) $data['number_of_copies'];
            $data['book_binding_id'] = (int) $data['book_binding_id'];

            return $data;
        });
    }
}
