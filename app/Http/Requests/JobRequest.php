<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3', 'max:255'],
            'salary' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
