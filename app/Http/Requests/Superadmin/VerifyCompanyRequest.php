<?php

namespace App\Http\Requests\Superadmin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VerifyCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isSuperadmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(['verified', 'rejected'])],
            'rejection_reason' => [
                Rule::requiredIf($this->input('status') === 'rejected'),
                'nullable',
                'string',
                'max:2000',
            ],
        ];
    }
}
