<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanySubmissionRequest;
use App\Http\Requests\ReuploadCompanyDocumentRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class CompanyProfileController extends Controller
{
    public function index(Request $request): View
    {
        $this->flashNextApproval($request);

        return view('company.profile.index', [
            'companies' => $request->user()->companies()->withCount('vacancies')->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('company.profile.form', ['company' => new Company]);
    }

    public function store(CompanySubmissionRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $documentPath = $request->file('document')->store('company-documents', 'local');
        $logo = $request->file('logo');

        if (! is_string($documentPath)) {
            throw new RuntimeException('Dokumen perusahaan gagal disimpan.');
        }

        $company = new Company;
        $company->fill([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'legal_name' => $validated['legal_name'] ?? null,
            'region' => $validated['region'],
            'owner_name' => $validated['owner_name'],
            'outlets_count' => $validated['outlets_count'],
        ]);

        if ($logo !== null) {
            $logoPath = $logo->store('company-logos', 'public');
            if (! is_string($logoPath)) {
                throw new RuntimeException('Logo perusahaan gagal disimpan.');
            }
            $company->logo_path = $logoPath;
        }

        $company->forceFill([
            'owner_id' => $request->user()->getKey(),
            'document_path' => $documentPath,
            'status' => 'pending',
            'verification_status' => 'pending',
            'submitted_by' => $request->user()->getKey(),
        ])->save();

        return redirect()->route('company.profile.index')->with('success', 'Perusahaan dikirim dan menunggu verifikasi.');
    }

    public function show(Request $request, Company $company): View
    {
        $this->authorize('view', $company);
        $this->flashNextApproval($request, $company);

        return view('company.profile.show', [
            'company' => $company->loadCount('vacancies'),
        ]);
    }

    public function reupload(
        ReuploadCompanyDocumentRequest $request,
        Company $company,
    ): RedirectResponse {
        $newDocumentPath = $request->file('document')->store('company-documents', 'local');

        if (! is_string($newDocumentPath)) {
            throw new RuntimeException('Dokumen perusahaan gagal disimpan.');
        }

        $oldDocumentPath = $company->document_path;
        $company->forceFill([
            'document_path' => $newDocumentPath,
            'status' => 'pending',
            'verification_status' => 'pending',
            'verified_at' => null,
            'verified_by' => null,
            'reviewed_by' => null,
            'approval_notified_at' => null,
        ])->save();

        if ($oldDocumentPath !== null) {
            Storage::disk('local')->delete($oldDocumentPath);
        }

        return redirect()->route('company.profile.show', $company)->with('success', 'Dokumen baru dikirim. Alasan penolakan sebelumnya tetap tersimpan.');
    }

    private function flashNextApproval(Request $request, ?Company $company = null): void
    {
        $request->session()->forget('company_approved');

        $approvedCompany = DB::transaction(function () use ($request, $company): ?Company {
            $query = $request->user()->companies()
                ->where('status', 'verified')
                ->whereNull('approval_notified_at');

            if ($company !== null) {
                $query->whereKey($company->getKey());
            }

            $approvedCompany = $query->lockForUpdate()->first();

            if ($approvedCompany !== null) {
                $approvedCompany->forceFill(['approval_notified_at' => now()])->save();
            }

            return $approvedCompany;
        });

        if ($approvedCompany !== null) {
            $request->session()->flash('company_approved', true);
        }
    }
}
