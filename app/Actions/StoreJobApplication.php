<?php

namespace App\Actions;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class StoreJobApplication
{
    /**
     * @param  array<string, mixed>  $applicationData
     * @param  array<string, mixed>  $job
     * @param  array<int, UploadedFile>  $supportingDocuments
     */
    public function handle(
        User $user,
        array $job,
        array $applicationData,
        UploadedFile $cv,
        array $supportingDocuments = [],
    ): JobApplication {
        $storedPaths = [];

        try {
            return DB::transaction(function () use ($user, $job, $applicationData, $cv, $supportingDocuments, &$storedPaths): JobApplication {
                $application = JobApplication::create([
                    ...$applicationData,
                    'user_id' => $user->getKey(),
                    'job_listing_id' => $job['id'],
                    'job_title' => $job['title'],
                    'company_name' => $job['company'],
                ]);

                $documents = [
                    ['type' => 'cv', 'file' => $cv],
                    ...array_map(
                        static fn (UploadedFile $file): array => ['type' => 'supporting', 'file' => $file],
                        $supportingDocuments,
                    ),
                ];

                foreach ($documents as $document) {
                    $file = $document['file'];
                    $path = $file->store("job-applications/{$application->getKey()}", 'local');

                    if (! is_string($path)) {
                        throw new RuntimeException('Dokumen lamaran gagal disimpan.');
                    }

                    $storedPaths[] = $path;

                    $application->documents()->create([
                        'document_type' => $document['type'],
                        'file_path' => $path,
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type' => $file->getMimeType() ?? 'application/octet-stream',
                        'size_bytes' => $file->getSize(),
                    ]);
                }

                return $application;
            });
        } catch (Throwable $exception) {
            if ($storedPaths !== [] && ! Storage::disk('local')->delete($storedPaths)) {
                Log::warning('Failed to remove uploaded application documents after a database error.');
            }

            throw $exception;
        }
    }
}
