<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreJobApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() instanceof User;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:15', 'max:70'],
            'education' => ['required', 'in:SMA/SMK,D1/D3,S1'],
            'email' => ['required', 'email', 'max:255'],
            'application_file' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
            'supporting_documents' => ['sometimes', 'array', 'max:3'],
            'supporting_documents.*' => ['file', 'mimes:pdf,doc,docx', 'max:10240'],
        ];
    }
}
