<?php

namespace App\Http\Controllers;

use App\Support\JobListings;
use Illuminate\View\View;

class LowonganController extends Controller
{
    public function index(): View
    {
        return view('lowongan', ['jobs' => JobListings::management()]);
    }
}
