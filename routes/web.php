<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('companies.index'));
Route::get('/perusahaan', [CompanyController::class, 'index'])->name('companies.index');
