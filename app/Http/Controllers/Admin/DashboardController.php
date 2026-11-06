<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $companyIds = $request->user()->companies()->where('status', 'verified')->select('id');

        return view('admin.dashboard', [
            'vacancyCount' => Vacancy::query()->whereIn('company_id', $companyIds)->count(),
            'applicationCount' => JobApplication::query()->whereHas(
                'vacancy',
                fn ($query) => $query->whereIn('company_id', $companyIds),
            )->count(),
            'recentVacancies' => Vacancy::query()
                ->whereIn('company_id', $companyIds)
                ->with('company')
                ->withCount('applications')
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }
}
