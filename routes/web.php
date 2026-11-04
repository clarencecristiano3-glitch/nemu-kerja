<?php

use App\Http\Controllers\Admin\CareerTipController as AdminCareerTipController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\CompanyVerificationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\JobApplicationVerificationController;
use App\Http\Controllers\Admin\VacancyController as AdminVacancyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DetailJobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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
    ->middleware(['auth', 'role:admin'])
    ->group(function (): void {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('vacancies', AdminVacancyController::class)->except('show');
        Route::resource('companies', AdminCompanyController::class)->except('show');
        Route::get('applications', [JobApplicationVerificationController::class, 'index'])->name('applications.index');
        Route::get('applications/{jobApplication}', [JobApplicationVerificationController::class, 'show'])->name('applications.show');
        Route::patch('applications/{jobApplication}', [JobApplicationVerificationController::class, 'update'])->name('applications.update');
        Route::get('application-documents/{document}', [JobApplicationVerificationController::class, 'document'])->name('application-documents.show');
        Route::get('verifications', [CompanyVerificationController::class, 'index'])->name('verifications.index');
        Route::patch('verifications/{company}', [CompanyVerificationController::class, 'update'])->name('verifications.update');
        Route::resource('career-tips', AdminCareerTipController::class)->except('show');
    });
