<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVacancyRequest;
use App\Http\Requests\Admin\UpdateVacancyRequest;
use App\Models\Company;
use App\Models\Vacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class VacancyController extends Controller
{
    public function index(): View
    {
        return view('superadmin.vacancies.index', [
            'vacancies' => Vacancy::query()
                ->with('company')
                ->withCount('applications')
                ->latest()
                ->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('superadmin.vacancies.form', [
            'vacancy' => new Vacancy,
            'companies' => Company::query()->orderBy('name')->get(),
        ]);
    }

    public function store(StoreVacancyRequest $request): RedirectResponse
    {
        $validated = $this->normalizeListFields($request->validated());
        $imagePath = $validated['image']->store('vacancies', 'public');

        if (! is_string($imagePath)) {
            throw new RuntimeException('Gambar lowongan gagal disimpan.');
        }

        unset($validated['image']);
        $validated['image_path'] = $imagePath;
        $validated['created_by'] = Auth::id();
        $validated = $this->enforceCompanyVerification($validated);

        $vacancy = new Vacancy;
        $vacancy->fill(Arr::except($validated, 'company_id'));
        $vacancy->company_id = $validated['company_id'];
        $vacancy->save();

        return redirect()->route('superadmin.vacancies.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit(Vacancy $vacancy): View
    {
        return view('superadmin.vacancies.form', [
            'vacancy' => $vacancy,
            'companies' => Company::query()->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateVacancyRequest $request, Vacancy $vacancy): RedirectResponse
    {
        $validated = $this->enforceCompanyVerification($this->normalizeListFields($request->validated()));
        $image = $validated['image'] ?? null;
        unset($validated['image']);
        $oldImagePath = null;

        if ($image !== null) {
            $imagePath = $image->store('vacancies', 'public');

            if (! is_string($imagePath)) {
                throw new RuntimeException('Gambar lowongan gagal disimpan.');
            }

            $oldImagePath = $vacancy->image_path;
            $validated['image_path'] = $imagePath;
        }

        $vacancy->fill(Arr::except($validated, 'company_id'));
        $vacancy->company_id = $validated['company_id'];
        $vacancy->save();

        if ($oldImagePath !== null) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return redirect()->route('superadmin.vacancies.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(Vacancy $vacancy): RedirectResponse
    {
        $vacancy->delete();

        return redirect()->route('superadmin.vacancies.index')->with('success', 'Lowongan berhasil diarsipkan.');
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function normalizeListFields(array $data): array
    {
        foreach (['responsibilities', 'qualifications', 'schedule', 'benefits'] as $field) {
            $data[$field] = filled($data[$field] ?? null)
                ? array_values(array_filter(array_map('trim', preg_split('/\R/u', $data[$field]) ?: [])))
                : null;
        }

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function enforceCompanyVerification(array $data): array
    {
        if ($data['status'] === 'published'
            && Company::query()->whereKey($data['company_id'])->where('verification_status', 'approved')->doesntExist()) {
            $data['status'] = 'draft';
            session()->flash('notice', 'Perusahaan belum terverifikasi; lowongan disimpan sebagai draft.');
        }

        return Arr::only($data, [
            'company_id',
            'created_by',
            'image',
            'image_path',
            'title',
            'position',
            'employment_type',
            'category',
            'minimum_education',
            'maximum_age',
            'needed',
            'quota',
            'location',
            'address',
            'description',
            'responsibilities',
            'qualifications',
            'schedule',
            'benefits',
            'expires_at',
            'status',
        ]);
    }
}
