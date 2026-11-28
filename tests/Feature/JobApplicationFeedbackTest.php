<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('successful job applications show feedback and store the application', function () {
    Storage::fake('local');

    $user = User::factory()->create([
        'birth_date' => '1995-05-10',
    ]);

    $company = new Company;
    $company->forceFill([
        'owner_id' => $user->getKey(),
        'name' => 'Perusahaan Contoh',
        'slug' => 'perusahaan-contoh',
        'region' => 'Pontianak',
        'owner_name' => $user->name,
        'outlets_count' => 1,
        'status' => 'verified',
        'verification_status' => 'approved',
    ])->save();

    $vacancy = $company->vacancies()->create([
        'title' => 'Web Developer',
        'position' => 'Developer',
        'employment_type' => 'Full time',
        'category' => 'Teknologi',
        'minimum_education' => 'S1',
        'maximum_age' => 35,
        'needed' => 1,
        'quota' => 10,
        'location' => 'Pontianak',
        'description' => 'Membangun aplikasi.',
        'status' => 'published',
    ]);

    $this->actingAs($user)
        ->post(route('job.application.store', ['jobId' => $vacancy->getKey()]), [
            'full_name' => $user->name,
            'birth_date' => '1995-05-10',
            'education' => 'S1',
            'email' => $user->email,
            'application_file' => UploadedFile::fake()->create('cv.pdf', 100, 'application/pdf'),
        ])
        ->assertRedirect(route('job.apply', ['jobId' => $vacancy->getKey()]))
        ->assertSessionHas(
            'success',
            'Lamaran Anda untuk Web Developer berhasil dikirim.',
        );

    $this->assertDatabaseHas('job_applications', [
        'user_id' => $user->getKey(),
        'job_listing_id' => $vacancy->getKey(),
        'job_title' => 'Web Developer',
    ]);
});
