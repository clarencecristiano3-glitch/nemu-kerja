<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCareerTipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:255'],
            'summary' => ['required', 'string', 'max:1000'],
            'body' => ['required', 'string', 'max:50000'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ];
    }
}
