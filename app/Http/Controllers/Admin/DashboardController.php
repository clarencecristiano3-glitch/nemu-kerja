<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerTip;
use App\Models\Company;
use App\Models\JobApplication;
use App\Models\Vacancy;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'vacancyCount' => Vacancy::query()->count(),
            'companyCount' => Company::query()->count(),
            'pendingCompanyCount' => Company::query()->where('verification_status', 'pending')->count(),
            'careerTipCount' => CareerTip::query()->count(),
            'applicationCount' => JobApplication::query()->count(),
            'recentVacancies' => Vacancy::query()->with('company')->withCount('applications')->latest()->limit(5)->get(),
        ]);
    }
}
