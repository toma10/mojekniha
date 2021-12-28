<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (is_string($this->tags)) {
            $this->merge([
                'tags' => Str::of($this->tags)->explode(',')->map(fn ($tag) => trim($tag))->toArray(),
            ]);
        }

        if (is_string($this->genres)) {
            $this->merge([
                'genres' => Str::of($this->genres)->explode(',')->map(fn ($genre) => trim($genre))->toArray(),
            ]);
        }
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
            'genres' => ['sometimes', 'array'],
            'genres.*' => ['integer'],
            'tags' => ['sometimes', 'array'],
            'tags.*' => ['integer'],
        ];
    }
}
