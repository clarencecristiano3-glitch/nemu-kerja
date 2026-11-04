<?php

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    $this->admin = User::factory()->create();
    $this->admin->forceFill(['role' => User::ROLE_ADMIN])->save();
    $this->applicant = User::factory()->create();

    $this->company = Company::query()->create([
        'name' => 'Jojo Juice',
        'slug' => fake()->unique()->slug(),
        'region' => 'Jakarta',
        'verification_status' => 'approved',
    ]);

    $this->vacancy = Vacancy::query()->create([
        'company_id' => $this->company->getKey(),
        'title' => 'Crew Outlet',
        'position' => 'Crew',
        'employment_type' => 'Full-time',
        'category' => 'Food and Beverage',
        'minimum_education' => 'SMA/SMK',
        'maximum_age' => 35,
        'needed' => 2,
        'quota' => 2,
        'location' => 'Jakarta',
        'description' => 'Melayani pelanggan.',
        'status' => 'published',
    ]);

    $this->application = JobApplication::query()->create([
        'user_id' => $this->applicant->getKey(),
        'job_listing_id' => $this->vacancy->getKey(),
        'job_title' => $this->vacancy->title,
        'company_name' => $this->company->name,
        'full_name' => 'Jojo Applicant',
        'age' => 22,
        'education' => 'S1',
        'email' => 'applicant@example.com',
    ]);
});

it('lists new applications in the admin verification queue by company and vacancy', function (): void {
    $response = $this->actingAs($this->admin)->get(route('admin.applications.index'));

    $response->assertSuccessful()
        ->assertSee('Jojo Applicant')
        ->assertSee('Jojo Juice')
        ->assertSee('Crew Outlet')
        ->assertSee('Menunggu');

    expect($this->application->fresh()->status)->toBe(JobApplication::STATUS_PENDING);
});

it('shows applicant details and documents to admins', function (): void {
    $document = $this->application->documents()->create([
        'document_type' => 'cv',
        'file_path' => 'job-applications/1/cv.pdf',
        'original_name' => 'CV Jojo.pdf',
        'mime_type' => 'application/pdf',
        'size_bytes' => 100,
    ]);

    $this->actingAs($this->admin)
        ->get(route('admin.applications.show', $this->application))
        ->assertSuccessful()
        ->assertSee('Jojo Applicant')
        ->assertSee('22 tahun')
        ->assertSee('S1')
        ->assertSee('applicant@example.com')
        ->assertSee('CV Jojo.pdf')
        ->assertSee(route('admin.application-documents.show', $document));
});

it('lets admins open a private application document', function (): void {
    Storage::fake('local');
    Storage::disk('local')->put('job-applications/1/cv.pdf', 'CV sample');

    $document = $this->application->documents()->create([
        'document_type' => 'cv',
        'file_path' => 'job-applications/1/cv.pdf',
        'original_name' => 'CV Jojo.pdf',
        'mime_type' => 'application/pdf',
        'size_bytes' => 9,
    ]);

    $response = $this->actingAs($this->admin)
        ->get(route('admin.application-documents.show', $document))
        ->assertSuccessful()
        ->assertHeader('content-type', 'application/pdf');

    ob_start();
    $response->baseResponse->sendContent();
    $fileContents = ob_get_clean();

    expect($fileContents)->toBe('CV sample');
});

it('allows admins to verify or reject an application with a review note', function (): void {
    $this->actingAs($this->admin)
        ->patch(route('admin.applications.update', $this->application), [
            'status' => JobApplication::STATUS_REVIEWED,
            'review_note' => 'Dokumen sudah diperiksa.',
        ])
        ->assertRedirect();

    $this->application->refresh();

    expect($this->application->status)->toBe(JobApplication::STATUS_REVIEWED)
        ->and($this->application->review_note)->toBe('Dokumen sudah diperiksa.')
        ->and($this->application->reviewed_by)->toBe($this->admin->getKey())
        ->and($this->application->reviewed_at)->not->toBeNull();

    $this->actingAs($this->admin)
        ->patch(route('admin.applications.update', $this->application), [
            'status' => JobApplication::STATUS_REJECTED,
        ])
        ->assertRedirect();

    expect($this->application->fresh()->status)->toBe(JobApplication::STATUS_REJECTED);
});

it('keeps the application queue and documents restricted to admins', function (): void {
    $document = $this->application->documents()->create([
        'document_type' => 'cv',
        'file_path' => 'job-applications/1/cv.pdf',
        'original_name' => 'CV Jojo.pdf',
        'mime_type' => 'application/pdf',
        'size_bytes' => 100,
    ]);

    $this->actingAs($this->applicant)
        ->get(route('admin.applications.index'))
        ->assertForbidden();

    $this->actingAs($this->applicant)
        ->get(route('admin.applications.show', $this->application))
        ->assertForbidden();

    $this->actingAs($this->applicant)
        ->get(route('admin.application-documents.show', $document))
        ->assertForbidden();
});
