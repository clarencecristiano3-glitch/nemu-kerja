<?php

namespace App\Http\Controllers;

use App\Actions\StoreJobApplication;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\RedirectResponse;

class JobApplicationController extends Controller
{
    public function store(
        StoreJobApplicationRequest $request,
        int $jobId,
        StoreJobApplication $storeJobApplication,
    ): RedirectResponse {
        $vacancy = Vacancy::query()
            ->whereKey($jobId)
            ->where('status', 'published')
            ->whereHas('company', static fn ($query) => $query->where('verification_status', 'approved'))
            ->with('company')
            ->firstOrFail();
        $job = $vacancy->toListingArray();

        $user = $request->user();
        abort_unless($user instanceof User, 403);

        $validated = $request->validated();
        $cv = $validated['application_file'];
        $supportingDocuments = $validated['supporting_documents'] ?? [];
        unset($validated['application_file'], $validated['supporting_documents']);

        $storeJobApplication->handle(
            $user,
            $job,
            $validated,
            $cv,
            $supportingDocuments,
        );

        return redirect()
            ->route('job.apply', ['jobId' => $jobId])
            ->with('success', 'Lamaran berhasil dikirim.');
    }
}
