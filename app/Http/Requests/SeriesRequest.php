<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesRequest extends FormRequest
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
            'author_id' => ['required', 'integer', 'exists:authors,id'],
        ];
    }

    /**
     * @return array<array<string, mixed>>
     */
    public function validated(): array
    {
        return transform(parent::validated(), function ($data) {
            $data['author_id'] = (int) $data['author_id'];

            return $data;
        });
    }
}
