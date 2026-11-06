<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanySubmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() instanceof User && ! $this->user()->isSuperadmin();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'alpha_dash', 'max:255', Rule::unique('companies', 'slug')],
            'legal_name' => ['nullable', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'owner_name' => ['required', 'string', 'max:255'],
            'outlets_count' => ['required', 'integer', 'min:1', 'max:100000'],
            'document' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
