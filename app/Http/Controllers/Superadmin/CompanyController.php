<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function index(): View
    {
        return view('superadmin.companies.index', [
            'companies' => Company::query()->with(['owner', 'verifiedBy'])->withCount('vacancies')->latest()->paginate(20),
        ]);
    }
}
