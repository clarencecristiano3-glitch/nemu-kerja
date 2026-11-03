<?php

namespace App\Http\Controllers;

use App\Support\JobListings;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LowonganController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = mb_strtolower(trim((string) $request->query('keyword', '')));
        $location = mb_strtolower(trim((string) $request->query('location', '')));

        $jobs = array_values(array_filter(
            JobListings::all(),
            static function (array $job) use ($keyword, $location): bool {
                $searchable = mb_strtolower(implode(' ', [
                    $job['company'],
                    $job['position'],
                    $job['education'],
                    $job['location'],
                    $job['category'],
                ]));

                return ($keyword === '' || str_contains($searchable, $keyword))
                    && ($location === '' || str_contains(mb_strtolower($job['location']), $location));
            }
        ));

        return view('lowongan', compact('jobs', 'keyword', 'location'));
    }
}
