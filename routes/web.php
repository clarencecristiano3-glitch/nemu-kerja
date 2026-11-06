<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\JobApplicationVerificationController as AdminJobApplicationVerificationController;
use App\Http\Controllers\Admin\VacancyController as AdminVacancyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyDocumentController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\DetailJobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Superadmin\CareerTipController as SuperadminCareerTipController;
use App\Http\Controllers\Superadmin\CompanyController as SuperadminCompanyController;
use App\Http\Controllers\Superadmin\CompanyVerificationController;
use App\Http\Controllers\Superadmin\DashboardController as SuperadminDashboardController;
use App\Http\Controllers\Superadmin\JobApplicationVerificationController;
use App\Http\Controllers\Superadmin\UserController as SuperadminUserController;
use App\Http\Controllers\Superadmin\VacancyController as SuperadminVacancyController;
use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobApplicationDocument;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Route;

Route::bind('company', function (string $value): Company {
    $company = Company::query()->whereKey($value);
    $user = request()->user();

    if (! $user?->isSuperadmin() && $user !== null) {
        $company->where('owner_id', $user->getKey());
    }

    return $company->firstOrFail();
});

Route::bind('vacancy', function (string $value): Vacancy {
    $vacancy = Vacancy::query()->whereKey($value);
    $user = request()->user();

    if (! $user?->isSuperadmin() && $user !== null) {
        $vacancy->whereHas('company', fn ($query) => $query->whereBelongsTo($user, 'owner'));
    }

    return $vacancy->firstOrFail();
});

Route::bind('jobApplication', function (string $value): JobApplication {
    $application = JobApplication::query()->whereKey($value);
    $user = request()->user();

    if (! $user?->isSuperadmin() && $user !== null) {
        $application->whereHas('vacancy.company', fn ($query) => $query->whereBelongsTo($user, 'owner'));
    }

    return $application->firstOrFail();
});

Route::bind('document', function (string $value): JobApplicationDocument {
    $document = JobApplicationDocument::query()->whereKey($value);
    $user = request()->user();

    if (! $user?->isSuperadmin() && $user !== null) {
        $document->whereHas('jobApplication.vacancy.company', fn ($query) => $query->whereBelongsTo($user, 'owner'));
    }

    return $document->firstOrFail();
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [HomeController::class, 'jobs'])->name('jobs.index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/profile/companies', [CompanyProfileController::class, 'index'])->name('company.profile.index');
    Route::get('/profile/companies/create', [CompanyProfileController::class, 'create'])->name('company.profile.create');
    Route::post('/profile/companies', [CompanyProfileController::class, 'store'])->name('company.profile.store');
    Route::get('/profile/companies/{company}', [CompanyProfileController::class, 'show'])->name('company.profile.show');
    Route::post('/profile/companies/{company}/document', [CompanyProfileController::class, 'reupload'])
        ->name('company.profile.reupload');
    Route::get('/profile/companies/{company}/document', [CompanyDocumentController::class, 'show'])
        ->name('company.profile.document');

    Route::get('/job/apply', [DetailJobController::class, 'apply'])->name('job.apply.default');
    Route::get('/job/{jobId}/apply', [DetailJobController::class, 'apply'])
        ->whereNumber('jobId')
        ->name('job.apply');
    Route::post('/job/{jobId}/apply', [JobApplicationController::class, 'store'])
        ->whereNumber('jobId')
        ->name('job.application.store');
});
Route::get('/job/{jobId?}', [DetailJobController::class, 'show'])
    ->whereNumber('jobId')
    ->name('job.detail');
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/tips', [HomeController::class, 'tips'])->name('tips.index');

// Rute publik (bisa diakses tanpa harus login)
Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');

// Rute yang tetap butuh autentikasi (misalnya aksi hapus)
Route::middleware(['auth'])->group(function () {
    Route::delete('/lowongan/{id}', [LowonganController::class, 'destroy'])->name('lowongan.destroy');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:company_admin'])
    ->group(function (): void {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('vacancies', AdminVacancyController::class)->except('show');
        Route::get('applications', [AdminJobApplicationVerificationController::class, 'index'])->name('applications.index');
        Route::get('applications/{jobApplication}', [AdminJobApplicationVerificationController::class, 'show'])->name('applications.show');
        Route::patch('applications/{jobApplication}', [AdminJobApplicationVerificationController::class, 'update'])->name('applications.update');
        Route::get('application-documents/{document}', [AdminJobApplicationVerificationController::class, 'document'])->name('application-documents.show');
    });

Route::prefix('superadmin')
    ->name('superadmin.')
    ->middleware(['auth', 'role:superadmin'])
    ->group(function (): void {
        Route::get('/', [SuperadminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('vacancies', SuperadminVacancyController::class)->except('show');
        Route::get('companies', [SuperadminCompanyController::class, 'index'])->name('companies.index');
        Route::get('users', [SuperadminUserController::class, 'index'])->name('users.index');
        Route::get('applications', [JobApplicationVerificationController::class, 'index'])->name('applications.index');
        Route::get('applications/{jobApplication}', [JobApplicationVerificationController::class, 'show'])->name('applications.show');
        Route::patch('applications/{jobApplication}', [JobApplicationVerificationController::class, 'update'])->name('applications.update');
        Route::get('application-documents/{document}', [JobApplicationVerificationController::class, 'document'])->name('application-documents.show');
        Route::get('verifications', [CompanyVerificationController::class, 'index'])->name('verifications.index');
        Route::get('verifications/{company}', [CompanyVerificationController::class, 'show'])->name('verifications.show');
        Route::get('verifications/{company}/document', [CompanyVerificationController::class, 'document'])->name('verifications.document');
        Route::patch('verifications/{company}', [CompanyVerificationController::class, 'update'])->name('verifications.update');
        Route::resource('career-tips', SuperadminCareerTipController::class)->except('show');
    });
