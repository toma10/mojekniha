<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'birth_date' => ['required', 'date'],
            'death_date' => ['nullable', 'date'],
            'biography' => ['nullable', 'string'],
            'nationality_id' => ['required', 'exists:nationalities,id'],
            'portrait_image' => ['nullable', 'image', 'mimes:jpeg,jpg', Rule::dimensions()->minWidth(400)],
        ];
    }
}
