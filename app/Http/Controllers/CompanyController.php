<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Support\JobListings;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function index(): View
    {
        $companies = Company::query()
            ->where('verification_status', 'approved')
            ->latest()
            ->paginate(12);

        return view('company-list', compact('companies'));
    }

    public function show(string $slug): View
    {
        $company = Company::query()
            ->where('verification_status', 'approved')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('company.show', [
            'company' => $company,
            'jobs' => JobListings::forCompany($company),
        ]);
    }
}
