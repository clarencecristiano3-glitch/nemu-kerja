<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVacancyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        $companyRule = Rule::exists('companies', 'id');
        if ($this->user()?->isCompanyAdmin()) {
            $companyRule->where(fn ($query) => $query
                ->where('owner_id', $this->user()->getKey())
                ->where('status', 'verified'));
        }

        return [
            'company_id' => ['required', 'integer', $companyRule],
            'title' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'employment_type' => ['required', Rule::in(['Part time', 'Full time'])],
            'category' => ['required', 'string', 'max:255'],
            'minimum_education' => ['required', 'string', 'max:255'],
            'maximum_age' => ['required', 'integer', 'min:15', 'max:100'],
            'needed' => ['required', 'integer', 'min:1', 'max:100000'],
            'quota' => ['required', 'integer', 'min:1', 'max:100000'],
            'location' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:10000'],
            'responsibilities' => ['nullable', 'string', 'max:10000'],
            'qualifications' => ['nullable', 'string', 'max:10000'],
            'schedule' => ['nullable', 'string', 'max:10000'],
            'benefits' => ['nullable', 'string', 'max:10000'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:today'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ];
    }
}
