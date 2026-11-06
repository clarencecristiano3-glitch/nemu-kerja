<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CompanyDocumentController extends Controller
{
    public function show(Company $company): BinaryFileResponse
    {
        $this->authorize('view', $company);
        abort_unless($company->document_path !== null, 404);

        $disk = Storage::disk('local');
        abort_unless($disk->exists($company->document_path), 404);

        return response()
            ->file($disk->path($company->document_path), [
                'X-Content-Type-Options' => 'nosniff',
            ]);
    }
}
