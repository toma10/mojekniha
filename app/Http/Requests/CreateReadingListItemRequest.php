<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReadingListItemRequest extends FormRequest
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
        ];
    }

    /**
     * @return array<array<string, mixed>>
     */
    public function validated(): array
    {
        return transform(parent::validated(), function ($data) {
            $data['book_id'] = (int) $data['book_id'];

            return $data;
        });
    }
}
