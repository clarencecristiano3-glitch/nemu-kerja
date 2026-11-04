<?php

namespace App\Http\Controllers;

use App\Models\CareerTip;
use App\Support\JobListings;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = [
            [
                'name' => 'Web Developer',
                'icon' => 'web_developer.png',
            ],
            [
                'name' => 'Design UI/UX',
                'icon' => 'design.png',
            ],
            [
                'name' => 'Data Analytic',
                'icon' => 'data_analytic.png',
            ],
            [
                'name' => 'Digital Marketing',
                'icon' => 'stock.png',
            ],
        ];

        return view('home', [
            'categories' => $categories,
            'jobs' => JobListings::featured(),
        ]);
    }

    public function jobs(Request $request): View
    {
        $keyword = mb_strtolower(trim((string) $request->query('keyword', '')));
        $location = mb_strtolower(trim((string) $request->query('location', '')));

        $jobs = array_values(array_filter(
            JobListings::featured(),
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

        return view('job-list', compact('jobs', 'keyword', 'location'));
    }

    public function tips(): View
    {
        return view('career-tips', [
            'careerTips' => CareerTip::query()
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->latest('published_at')
                ->paginate(12),
        ]);
    }
}
