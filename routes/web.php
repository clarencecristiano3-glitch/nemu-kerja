<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DetailJobController;
use App\Http\Controllers\HomeController;
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

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/job/apply', [DetailJobController::class, 'apply'])->name('job.apply.default');
Route::get('/job/{jobId}/apply', [DetailJobController::class, 'apply'])
    ->whereNumber('jobId')
    ->name('job.apply');
Route::get('/job/{jobId?}', [DetailJobController::class, 'show'])
    ->whereNumber('jobId')
    ->name('job.detail');
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');

// Rute publik (bisa diakses tanpa harus login)
Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');

// Rute yang tetap butuh autentikasi (misalnya aksi hapus)
Route::middleware(['auth'])->group(function () {
    Route::delete('/lowongan/{id}', [LowonganController::class, 'destroy'])->name('lowongan.destroy');
});
