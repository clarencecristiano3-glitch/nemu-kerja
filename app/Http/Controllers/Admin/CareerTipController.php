<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCareerTipRequest;
use App\Http\Requests\Admin\UpdateCareerTipRequest;
use App\Models\CareerTip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class CareerTipController extends Controller
{
    public function index(): View
    {
        return view('admin.career-tips.index', [
            'careerTips' => CareerTip::query()->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.career-tips.form', ['careerTip' => new CareerTip]);
    }

    public function store(StoreCareerTipRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $image = $validated['image'] ?? null;
        unset($validated['image']);
        $validated['created_by'] = Auth::id();
        $validated['published_at'] = $validated['status'] === 'published' ? now() : null;

        if ($image !== null) {
            $validated['image_path'] = $image->store('career-tips', 'public');

            if (! is_string($validated['image_path'])) {
                throw new RuntimeException('Gambar tips karier gagal disimpan.');
            }
        }

        CareerTip::create($validated);

        return redirect()->route('admin.career-tips.index')->with('success', 'Tips karier berhasil ditambahkan.');
    }

    public function edit(CareerTip $careerTip): View
    {
        return view('admin.career-tips.form', compact('careerTip'));
    }

    public function update(UpdateCareerTipRequest $request, CareerTip $careerTip): RedirectResponse
    {
        $validated = $request->validated();
        $image = $validated['image'] ?? null;
        unset($validated['image']);

        if ($image !== null) {
            $newImagePath = $image->store('career-tips', 'public');

            if (! is_string($newImagePath)) {
                throw new RuntimeException('Gambar tips karier gagal disimpan.');
            }

            $oldImagePath = $careerTip->image_path;
            $validated['image_path'] = $newImagePath;
        } else {
            $oldImagePath = null;
        }

        $validated['published_at'] = $validated['status'] === 'published'
            ? ($careerTip->published_at ?? now())
            : null;
        $careerTip->update($validated);

        if ($oldImagePath !== null) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return redirect()->route('admin.career-tips.index')->with('success', 'Tips karier berhasil diperbarui.');
    }

    public function destroy(CareerTip $careerTip): RedirectResponse
    {
        $careerTip->delete();

        if ($careerTip->image_path !== null) {
            Storage::disk('public')->delete($careerTip->image_path);
        }

        return redirect()->route('admin.career-tips.index')->with('success', 'Tips karier berhasil diarsipkan.');
    }
}
