<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobApplicationDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $statuses = [
            JobApplication::STATUS_PENDING,
            JobApplication::STATUS_REVIEWED,
            JobApplication::STATUS_REJECTED,
            'all',
        ];
        abort_unless(in_array($status, $statuses, true), 404);

        $applications = JobApplication::query()
            ->when($status !== 'all', static fn ($query) => $query->where('status', $status))
            ->with(['vacancy.company'])
            ->latest()
            ->paginate(15)
            ->withQueryString();
        $applicationsByCompany = $applications->getCollection()->groupBy(
            static fn (JobApplication $application): string => $application->vacancy?->company?->name
                ?? $application->company_name,
        );

        return view('superadmin.applications.index', [
            'applications' => $applications,
            'applicationsByCompany' => $applicationsByCompany,
            'status' => $status,
        ]);
    }

    public function show(JobApplication $jobApplication): View
    {
        $jobApplication->load(['user', 'vacancy.company', 'documents', 'reviewer']);

        return view('superadmin.applications.show', [
            'application' => $jobApplication,
        ]);
    }

    public function update(Request $request, JobApplication $jobApplication): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in([
                JobApplication::STATUS_REVIEWED,
                JobApplication::STATUS_REJECTED,
            ])],
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
        $disk = Storage::disk('local');
        abort_unless($disk->exists($document->file_path), 404);

        return response()
            ->file($disk->path($document->file_path), [
                'Content-Type' => $document->mime_type,
                'X-Content-Type-Options' => 'nosniff',
            ])
            ->setContentDisposition(
                'inline',
                $document->original_name,
                Str::ascii($document->original_name),
            );
    }
}
