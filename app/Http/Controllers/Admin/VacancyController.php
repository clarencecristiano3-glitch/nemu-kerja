<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVacancyRequest;
use App\Http\Requests\Admin\UpdateVacancyRequest;
use App\Models\Vacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class VacancyController extends Controller
{
    public function index(Request $request): View
    {
        $vacancies = Vacancy::query()
            ->whereHas('company', fn ($query) => $query->whereBelongsTo($request->user(), 'owner'))
            ->with('company')
            ->withCount('applications')
            ->latest()
            ->paginate(12);

        return view('admin.vacancies.index', compact('vacancies'));
    }

    public function create(Request $request): View
    {
        return view('admin.vacancies.form', [
            'vacancy' => new Vacancy,
            'companies' => $request->user()->companies()->where('status', 'verified')->orderBy('name')->get(),
        ]);
    }

    public function store(StoreVacancyRequest $request): RedirectResponse
    {
        $data = $this->normalizeListFields($request->validated());
        $imagePath = $request->file('image')->store('vacancies', 'public');

        if (! is_string($imagePath)) {
            throw new RuntimeException('Gambar lowongan gagal disimpan.');
        }

        $data['created_by'] = $request->user()->getKey();
        $vacancy = new Vacancy;
        $vacancy->fill(Arr::except($data, ['company_id', 'image']));
        $vacancy->company_id = $data['company_id'];
        $vacancy->image_path = $imagePath;
        $vacancy->save();

        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit(Vacancy $vacancy): View
    {
        $this->authorize('update', $vacancy);

        return view('admin.vacancies.form', [
            'vacancy' => $vacancy,
            'companies' => $vacancy->company->owner->companies()->where('status', 'verified')->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateVacancyRequest $request, Vacancy $vacancy): RedirectResponse
    {
        $data = $this->normalizeListFields($request->validated());
        $image = $data['image'] ?? null;
        unset($data['image']);
        $oldImagePath = null;

        if ($image !== null) {
            $imagePath = $image->store('vacancies', 'public');

            if (! is_string($imagePath)) {
                throw new RuntimeException('Gambar lowongan gagal disimpan.');
            }

            $oldImagePath = $vacancy->image_path;
            $data['image_path'] = $imagePath;
        }

        $vacancy->fill(Arr::except($data, 'company_id'));
        $vacancy->company_id = $data['company_id'];
        $vacancy->save();

        if ($oldImagePath !== null) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(Vacancy $vacancy): RedirectResponse
    {
        $this->authorize('delete', $vacancy);
        $vacancy->delete();

        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan berhasil diarsipkan.');
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
