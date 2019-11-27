<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'book_id' => ['required', 'exists:books,id'],
            'isbn' => ['required'],
            'release_year' => ['required', 'numeric', 'min:0'],
            'language_id' => ['required', 'exists:languages,id'],
            'number_of_pages' => ['required', 'numeric', 'min:0'],
            'number_of_copies' => ['required', 'numeric', 'min:0'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,jpg', Rule::dimensions()->minWidth(400)],
        ];
    }
}
