<?php

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the signed-in user profile and only counts their own accepted applications', function () {
    $user = User::factory()->create([
        'name' => 'Nemu User',
        'birth_date' => '1995-05-10',
    ]);
    $otherUser = User::factory()->create();

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
        'quota' => 1,
        'location' => 'Pontianak',
        'description' => 'Membangun aplikasi.',
        'status' => 'published',
    ]);

    $applicationAttributes = [
        'job_listing_id' => $vacancy->getKey(),
        'job_title' => $vacancy->title,
        'company_name' => $company->name,
        'full_name' => $user->name,
        'birth_date' => '1995-05-10',
        'education' => 'S1',
        'email' => $user->email,
    ];

    $user->jobApplications()->create([
        ...$applicationAttributes,
        'status' => JobApplication::STATUS_REVIEWED,
    ]);
    $user->jobApplications()->create([
        ...$applicationAttributes,
        'status' => JobApplication::STATUS_PENDING,
    ]);
    $otherUser->jobApplications()->create([
        ...$applicationAttributes,
        'status' => JobApplication::STATUS_REVIEWED,
    ]);

    $this->actingAs($user)
        ->get(route('profile.show'))
        ->assertOk()
        ->assertSee('Nemu User')
        ->assertSee('10/05/1995')
        ->assertSee('Perusahaan Contoh')
        ->assertSee('Lamaran diterima')
        ->assertViewHas('user', fn (User $profileUser): bool => $profileUser->job_applications_count === 2
            && $profileUser->accepted_applications_count === 1)
        ->assertViewHas('applications', fn ($applications): bool => $applications->total() === 2);
});

it('requires authentication to view the profile', function () {
    $this->get(route('profile.show'))
        ->assertRedirect(route('login'));
});
