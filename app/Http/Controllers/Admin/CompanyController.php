<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCompanyRequest;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class CompanyController extends Controller
{
    public function index(): View
    {
        return view('admin.companies.index', [
            'companies' => Company::query()->withCount('vacancies')->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.companies.form', ['company' => new Company]);
    }

    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $logo = $validated['logo'] ?? null;
        unset($validated['logo']);

        if ($logo !== null) {
            $validated['logo_path'] = $logo->store('company-logos', 'public');

            if (! is_string($validated['logo_path'])) {
                throw new RuntimeException('Logo perusahaan gagal disimpan.');
            }
        }

        $validated['verification_status'] = 'pending';
        $validated['submitted_by'] = Auth::id();
        Company::create($validated);

        return redirect()->route('admin.companies.index')->with('success', 'Perusahaan berhasil ditambahkan dan menunggu verifikasi.');
    }

    public function edit(Company $company): View
    {
        return view('admin.companies.form', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        $validated = $request->validated();
        $logo = $validated['logo'] ?? null;
        unset($validated['logo']);

        if ($logo !== null) {
            $newLogoPath = $logo->store('company-logos', 'public');

            if (! is_string($newLogoPath)) {
                throw new RuntimeException('Logo perusahaan gagal disimpan.');
            }

            $validated['logo_path'] = $newLogoPath;
        }

        $oldLogoPath = $company->logo_path;
        $company->update($validated);
        $company->update([
            'verification_status' => 'pending',
            'verified_at' => null,
            'reviewed_by' => null,
        ]);

        if ($logo !== null && $oldLogoPath !== null && ! str_starts_with($oldLogoPath, 'images/')) {
            Storage::disk('public')->delete($oldLogoPath);
        }

        return redirect()->route('admin.companies.index')->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    public function destroy(Company $company): RedirectResponse
    {
        if ($company->vacancies()->exists()) {
            return back()->withErrors(['company' => 'Perusahaan yang sudah memiliki lowongan tidak dapat dihapus.']);
        }

        $company->delete();
        $this->deleteStoredLogo($company);

        return redirect()->route('admin.companies.index')->with('success', 'Perusahaan berhasil dihapus.');
    }

    private function deleteStoredLogo(Company $company): void
    {
        if ($company->logo_path !== null && ! str_starts_with($company->logo_path, 'images/')) {
            Storage::disk('public')->delete($company->logo_path);
        }
    }
}
