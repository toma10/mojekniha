<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteReadingListItemRequest extends FormRequest
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
        return [];
    }
}
