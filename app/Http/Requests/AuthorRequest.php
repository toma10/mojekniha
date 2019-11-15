<?php

namespace App\Http\Requests;

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
        ];
    }
}
