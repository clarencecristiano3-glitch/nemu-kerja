<?php

use App\Enums\UserRole;
use App\Models\Company;
use App\Models\JobApplication;
use App\Models\User;
use App\Models\Vacancy;
use Database\Seeders\AdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

function companyAccessUser(string $role = 'user'): User
{
    $user = User::factory()->create();
    $user->forceFill(['role' => UserRole::from($role)])->save();

    return $user;
}

function companyAccessCompany(User $owner, string $status = 'pending', array $attributes = []): Company
{
    $company = new Company;
    $company->forceFill([
        'owner_id' => $owner->getKey(),
        'name' => fake()->company(),
        'slug' => fake()->unique()->slug(),
        'region' => 'Pontianak',
        'owner_name' => $owner->name,
        'outlets_count' => 1,
        'status' => $status,
        'verification_status' => $status === 'verified' ? 'approved' : $status,
        'verified_at' => $status === 'verified' ? now() : null,
        ...$attributes,
    ])->save();

    return $company;
}

function companyAccessVacancy(Company $company): Vacancy
{
    return $company->vacancies()->create([
        'title' => $company->name.' Staff',
        'position' => 'Staff',
        'employment_type' => 'Full time',
        'category' => 'Operasional',
        'minimum_education' => 'SMA/SMK',
        'maximum_age' => 35,
        'needed' => 1,
        'quota' => 10,
        'location' => 'Pontianak',
        'description' => 'Deskripsi lowongan.',
        'status' => 'draft',
    ]);
}

function companyAccessApplication(Vacancy $vacancy): JobApplication
{
    return JobApplication::query()->create([
        'user_id' => User::factory()->create()->getKey(),
        'job_listing_id' => $vacancy->getKey(),
        'job_title' => $vacancy->title,
        'company_name' => $vacancy->company->name,
        'full_name' => 'Pelamar',
        'age' => 25,
        'education' => 'SMA/SMK',
        'email' => 'applicant@example.test',
    ]);
}

it('keeps ordinary and pending users out of the admin area', function () {
    $user = companyAccessUser();
    $this->actingAs($user)->get(route('admin.dashboard'))->assertForbidden();

    companyAccessCompany($user);
    $this->actingAs($user)->get(route('admin.dashboard'))->assertForbidden();
});

it('submits a private company document without elevating the user role', function () {
    Storage::fake('local');
    $user = companyAccessUser();

    $this->actingAs($user)->post(route('company.profile.store'), [
        'name' => 'Perusahaan Contoh',
        'slug' => 'perusahaan-contoh',
        'legal_name' => 'PT Contoh',
        'region' => 'Pontianak',
        'owner_name' => $user->name,
        'outlets_count' => 1,
        'document' => UploadedFile::fake()->image('legalitas.png'),
    ])->assertRedirect(route('company.profile.index'));

    $company = $user->companies()->firstOrFail();
    expect($company->status)->toBe('pending')
        ->and($company->document_path)->not->toBeNull()
        ->and($user->fresh()->role)->toBe(UserRole::User);
    Storage::disk('local')->assertExists($company->document_path);
    $this->get(route('company.profile.document', $company))->assertOk();
});

it('allows rejected company owners to read the reason and resubmit documents', function () {
    Storage::fake('local');
    $user = companyAccessUser();
    $company = companyAccessCompany($user, 'rejected', ['rejection_reason' => 'Dokumen kurang jelas.']);

    $this->actingAs($user)
        ->get(route('company.profile.show', $company))
        ->assertOk()
        ->assertSee('Dokumen kurang jelas.');

    $this->post(route('company.profile.reupload', $company), [
        'document' => UploadedFile::fake()->image('legalitas-baru.png'),
    ])->assertRedirect(route('company.profile.show', $company));

    expect($company->fresh()->status)->toBe('pending')
        ->and($company->fresh()->rejection_reason)->toBe('Dokumen kurang jelas.')
        ->and($user->fresh()->role)->toBe(UserRole::User);
});

it('verifies a company transactionally and shows the approval toast once to its owner', function () {
    $owner = companyAccessUser();
    $superadmin = companyAccessUser('superadmin');
    $company = companyAccessCompany($owner);

    $this->actingAs($superadmin)
        ->patch(route('superadmin.verifications.update', $company), ['status' => 'verified'])
        ->assertRedirect(route('superadmin.verifications.show', $company));

    expect($company->fresh()->status)->toBe('verified')
        ->and($company->fresh()->verified_by)->toBe($superadmin->getKey())
        ->and($company->fresh()->approval_notified_at)->toBeNull()
        ->and($owner->fresh()->role)->toBe(UserRole::CompanyAdmin);

    $owner->refresh();

    $this->actingAs($owner)
        ->get(route('admin.dashboard'))
        ->assertOk();

    $this->get(route('company.profile.show', $company))
        ->assertOk()
        ->assertSee('Perusahaan Anda sudah disetujui');

    expect($company->fresh()->approval_notified_at)->not->toBeNull();

    $this->get(route('company.profile.show', $company))
        ->assertOk()
        ->assertDontSee('Perusahaan Anda sudah disetujui');

    $otherUser = companyAccessUser();
    $this->actingAs($otherUser)
        ->get(route('company.profile.index'))
        ->assertOk()
        ->assertDontSee('Perusahaan Anda sudah disetujui');
});

it('requires a rejection reason and does not show approval toasts for rejected or pending companies', function () {
    $owner = companyAccessUser();
    $superadmin = companyAccessUser('superadmin');
    $company = companyAccessCompany($owner);

    $this->actingAs($superadmin)
        ->patch(route('superadmin.verifications.update', $company), ['status' => 'rejected'])
        ->assertSessionHasErrors('rejection_reason');

    $this->patch(route('superadmin.verifications.update', $company), [
        'status' => 'rejected',
        'rejection_reason' => 'Dokumen tidak valid.',
    ])->assertRedirect(route('superadmin.verifications.show', $company));

    expect($owner->fresh()->role)->toBe(UserRole::User);

    $this->actingAs($owner)
        ->get(route('company.profile.index'))
        ->assertOk()
        ->assertDontSee('Perusahaan Anda sudah disetujui');

    $pendingCompany = companyAccessCompany($owner);
    $this->get(route('company.profile.show', $pendingCompany))
        ->assertOk()
        ->assertDontSee('Perusahaan Anda sudah disetujui');
});

it('restricts vacancies, applications and CV files to the owning company', function () {
    Storage::fake('local');
    $owner = companyAccessUser('company_admin');
    $otherOwner = companyAccessUser('company_admin');
    $ownCompany = companyAccessCompany($owner, 'verified');
    $otherCompany = companyAccessCompany($otherOwner, 'verified');
    $ownVacancy = companyAccessVacancy($ownCompany);
    $ownApplication = companyAccessApplication($ownVacancy);
    $ownDocument = $ownApplication->documents()->create([
        'document_type' => 'cv',
        'file_path' => 'application-documents/own-cv.pdf',
        'original_name' => 'own-cv.pdf',
        'mime_type' => 'application/pdf',
        'size_bytes' => 128,
    ]);
    $otherVacancy = companyAccessVacancy($otherCompany);
    $otherApplication = companyAccessApplication($otherVacancy);
    $document = $otherApplication->documents()->create([
        'document_type' => 'cv',
        'file_path' => 'application-documents/private-cv.pdf',
        'original_name' => 'cv.pdf',
        'mime_type' => 'application/pdf',
        'size_bytes' => 128,
    ]);
    Storage::disk('local')->put($document->file_path, '%PDF-1.4');
    Storage::disk('local')->put($ownDocument->file_path, '%PDF-1.4');

    $this->actingAs($owner)
        ->get(route('admin.applications.show', $ownApplication))
        ->assertOk()
        ->assertSee($ownApplication->full_name);
    $this->get(route('admin.application-documents.show', $ownDocument))->assertOk();
    $this->get(route('admin.vacancies.index'))
        ->assertOk()
        ->assertSee($ownVacancy->title)
        ->assertDontSee($otherVacancy->title);

    $this->get(route('admin.vacancies.edit', $otherVacancy))
        ->assertNotFound();
    $this->get(route('admin.applications.show', $otherApplication))
        ->assertNotFound();
    $this->get(route('admin.application-documents.show', $document))
        ->assertNotFound();
    $this->get(route('company.profile.show', $otherCompany))
        ->assertNotFound();

    $this->get(route('admin.vacancies.index'))
        ->assertOk()
        ->assertDontSee($otherVacancy->title);
    expect($ownVacancy->exists)->toBeTrue();
});

it('creates a separate superadmin account and leaves the existing admin account unchanged', function () {
    $oldAdmin = User::factory()->create(['username' => 'admin', 'email' => 'admin@example.test']);
    $company = companyAccessCompany(companyAccessUser());
    $previousPassword = getenv('SUPERADMIN_PASSWORD');
    putenv('SUPERADMIN_PASSWORD=test-superadmin-password');
    $_ENV['SUPERADMIN_PASSWORD'] = 'test-superadmin-password';

    try {
        app(AdminSeeder::class)->run();
        app(AdminSeeder::class)->run();
    } finally {
        unset($_ENV['SUPERADMIN_PASSWORD']);
        if ($previousPassword === false) {
            putenv('SUPERADMIN_PASSWORD');
        } else {
            putenv("SUPERADMIN_PASSWORD={$previousPassword}");
        }
    }

    $superadmin = User::query()->where('username', 'superadmin')->firstOrFail();
    $superadmin->refresh();
    $oldAdmin->refresh();
    expect($oldAdmin->role)->toBe(UserRole::User)
        ->and($superadmin->role)->toBe(UserRole::Superadmin)
        ->and(User::query()->where('username', 'superadmin')->count())->toBe(1)
        ->and(Hash::check('test-superadmin-password', $superadmin->password))->toBeTrue();

    $this->actingAs($superadmin)
        ->get(route('superadmin.verifications.index'))
        ->assertOk()
        ->assertSee($company->name);
    $this->get(route('superadmin.users.index'))->assertOk();
    $this->get(route('admin.dashboard'))->assertForbidden();
});

it('keeps legacy public company listings available after backfilling existing companies as verified', function () {
    $company = Company::query()->findOrFail(1);

    expect($company->status)->toBe('verified')
        ->and($company->verification_status)->toBe('approved');

    $this->get(route('companies.index'))->assertOk()->assertSee($company->name);
    $this->get(route('lowongan.index'))->assertOk()->assertSee($company->name);
});
