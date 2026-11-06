<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobApplicationDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class JobApplicationVerificationController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status', JobApplication::STATUS_PENDING);
        abort_unless(in_array($status, [
            JobApplication::STATUS_PENDING,
            JobApplication::STATUS_REVIEWED,
            JobApplication::STATUS_REJECTED,
            'all',
        ], true), 404);

        $applications = JobApplication::query()
            ->whereHas('vacancy.company', fn ($query) => $query->whereBelongsTo($request->user(), 'owner'))
            ->when($status !== 'all', fn ($query) => $query->where('status', $status))
            ->with(['vacancy.company'])
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.applications.index', [
            'applications' => $applications,
            'applicationsByCompany' => $applications->getCollection()->groupBy(
                fn (JobApplication $application): string => $application->vacancy?->company?->name
                    ?? $application->company_name,
            ),
            'status' => $status,
        ]);
    }

    public function show(JobApplication $jobApplication): View
    {
        $this->authorize('view', $jobApplication);
        $jobApplication->load(['user', 'vacancy.company', 'documents', 'reviewer']);

        return view('admin.applications.show', ['application' => $jobApplication]);
    }

    public function update(Request $request, JobApplication $jobApplication): RedirectResponse
    {
        $this->authorize('update', $jobApplication);
        $validated = $request->validate([
            'status' => ['required', Rule::in([JobApplication::STATUS_REVIEWED, JobApplication::STATUS_REJECTED])],
            'review_note' => ['nullable', 'string', 'max:2000'],
        ]);

        $jobApplication->update([
            ...$validated,
            'reviewed_by' => $request->user()->getKey(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Status lamaran berhasil diperbarui.');
    }

    public function document(JobApplicationDocument $document): BinaryFileResponse
    {
        Gate::authorize('view', $document->jobApplication);
        $disk = Storage::disk('local');
        abort_unless($disk->exists($document->file_path), 404);

        return response()
            ->file($disk->path($document->file_path), [
                'Content-Type' => $document->mime_type,
                'X-Content-Type-Options' => 'nosniff',
            ])
            ->setContentDisposition('inline', $document->original_name, Str::ascii($document->original_name));
    }
}
