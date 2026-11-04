<?php

namespace App\Http\Controllers;

use App\Models\Company;
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
}
