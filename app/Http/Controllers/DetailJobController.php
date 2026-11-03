<?php

namespace App\Http\Controllers;

use App\Support\JobListings;
use Illuminate\View\View;

class DetailJobController extends Controller
{
    public function show(?string $jobId = null): View
    {
        $job = $this->findJob($jobId);
        $job['company'] = $job['location'];

        return view('detail-job', compact('job'));
    }

    public function apply(?string $jobId = null): View
    {
        return view('apply-job', ['job' => $this->findJob($jobId)]);
    }

    private function findJob(?string $jobId): array
    {
        $job = JobListings::find((int) ($jobId ?? JobListings::DEFAULT_ID));

        abort_if($job === null, 404);

        return $job;
    }
}
