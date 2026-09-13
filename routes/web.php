<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DetailJobController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LowonganController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/job', [DetailJobController::class, 'show'])->name('job.detail');
Route::get('/job/apply', [DetailJobController::class, 'apply'])->name('job.apply');
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
    Route::delete('/lowongan/{id}', [LowonganController::class, 'destroy'])->name('lowongan.destroy');
});