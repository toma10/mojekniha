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
            'release_year' => ['required', 'integer', 'min:0'],
            'author_id' => ['required', 'integer', 'exists:authors,id'],
            'series_id' => ['nullable', 'integer', 'exists:series,id'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,jpg', Rule::dimensions()->minWidth(400)],
        ];
    }

    /**
     * @return array<array<string, mixed>>
     */
    public function validated(): array
    {
        return transform(parent::validated(), function ($data) {
            $data['release_year'] = (int) $data['release_year'];
            $data['author_id'] = (int) $data['author_id'];

            if ($data['series_id'] !== null) {
                $data['series_id'] = (int) $data['series_id'];
            }

            return $data;
        });
    }
}
