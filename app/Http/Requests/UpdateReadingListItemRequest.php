<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReadingListItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->ownsReadingListItem($this->readingListItem);
    }

    /**
     * @return array<array<string>>
     */
    public function rules(): array
    {
        return [
            'rating' => ['required', 'integer', 'min:0', 'max:5', 'nullable'],
            'notes' => ['required', 'string', 'nullable'],
        ];
    }
}
