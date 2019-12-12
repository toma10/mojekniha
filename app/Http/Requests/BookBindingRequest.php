<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookBindingRequest extends FormRequest
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
            'name' => ['required', 'unique:book_bindings,name'],
        ];
    }
}
