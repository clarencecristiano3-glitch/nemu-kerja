<?php

namespace App\Http\Controllers\Superadmin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Superadmin\VerifyCompanyRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CompanyVerificationController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status', 'pending');
        abort_unless(in_array($status, ['pending', 'verified', 'rejected', 'all'], true), 404);

        return view('superadmin.verifications.index', [
            'companies' => Company::query()
                ->with(['owner', 'verifiedBy'])
                ->withCount('vacancies')
                ->when($status !== 'all', fn ($query) => $query->where('status', $status))
                ->latest()
                ->paginate(12)
                ->withQueryString(),
            'status' => $status,
        ]);
    }

    public function show(Company $company): View
    {
        return view('superadmin.verifications.show', [
            'company' => $company->load(['owner', 'verifiedBy'])->loadCount('vacancies'),
        ]);
    }

    public function document(Request $request, Company $company): BinaryFileResponse
    {
        abort_unless($company->document_path !== null, 404);

        $disk = Storage::disk('local');
        abort_unless($disk->exists($company->document_path), 404);

        $path = $disk->path($company->document_path);

        if ($request->boolean('download')) {
            return response()->download($path);
        }

        return response()->file($path, [
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    public function update(VerifyCompanyRequest $request, Company $company): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($request, $company, $validated): void {
            $company = Company::query()->lockForUpdate()->findOrFail($company->getKey());

            if ($validated['status'] === 'verified') {
                $company->forceFill([
                    'status' => 'verified',
                    'verification_status' => 'approved',
                    'verified_at' => now(),
                    'verified_by' => $request->user()->getKey(),
                    'approval_notified_at' => null,
                    'rejection_reason' => null,
                    'review_note' => null,
                    'reviewed_by' => $request->user()->getKey(),
                ])->save();

                if ($company->owner !== null && ! $company->owner->isSuperadmin()) {
                    $company->owner->forceFill(['role' => UserRole::CompanyAdmin])->save();
                }

                return;
            }

            $company->forceFill([
                'status' => 'rejected',
                'verification_status' => 'rejected',
                'verified_at' => null,
                'verified_by' => null,
                'rejection_reason' => $validated['rejection_reason'],
                'review_note' => $validated['rejection_reason'],
                'reviewed_by' => $request->user()->getKey(),
            ])->save();

            $owner = $company->owner;
            if ($owner !== null && ! $owner->isSuperadmin()) {
                $hasVerifiedCompany = $owner->companies()
                    ->where('status', 'verified')
                    ->where('id', '<>', $company->getKey())
                    ->exists();
                $owner->forceFill([
                    'role' => $hasVerifiedCompany ? UserRole::CompanyAdmin : UserRole::User,
                ])->save();
            }
        });

        return redirect()
            ->route('superadmin.verifications.show', $company)
            ->with('success', $validated['status'] === 'verified'
                ? "Perusahaan {$company->name} berhasil diverifikasi."
                : "Perusahaan {$company->name} ditolak.");
    }
}
