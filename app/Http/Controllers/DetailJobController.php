<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DetailJobController extends Controller
{
    public function show(): View
    {
        $job = [
            'title' => "Hotway's - Part time",
            'company' => 'Hotway, Jl. Merdeka No 23, Pontianak',
            'location' => 'Pontianak',
            'category' => 'Pelayanan',
            'age' => 24,
            'education' => 'SMA/SMK',
            'remaining_days' => 6,
            'applicants' => 7,
            'quota' => 10,
        ];

        return view('detail-job', compact('job'));
    }
}