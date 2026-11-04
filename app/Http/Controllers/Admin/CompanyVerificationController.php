<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CompanyVerificationController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status', 'pending');
        abort_unless(in_array($status, ['pending', 'approved', 'rejected', 'all'], true), 404);

        $companies = Company::query()
            ->when($status !== 'all', static fn ($query) => $query->where('verification_status', $status))
            ->withCount('vacancies')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.verifications.index', [
            'companies' => $companies,
            'status' => $status,
        ]);
    }

    public function update(Request $request, Company $company): RedirectResponse
    {
        $validated = $request->validate([
            'verification_status' => ['required', Rule::in(['approved', 'rejected'])],
            'review_note' => ['nullable', 'string', 'max:2000'],
        ]);

        $company->update([
            ...$validated,
            'reviewed_by' => $request->user()->getKey(),
            'verified_at' => $validated['verification_status'] === 'approved' ? now() : null,
        ]);

        return back()->with('success', "Status verifikasi {$company->name} berhasil diperbarui.");
    }
}
