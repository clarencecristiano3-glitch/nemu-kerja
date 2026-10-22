<?php

namespace App\Http\Controllers;

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
            'jobs' => $this->jobListings(),
        ]);
    }

    public function jobs(Request $request): View
    {
        $keyword = mb_strtolower(trim((string) $request->query('keyword', '')));
        $location = mb_strtolower(trim((string) $request->query('location', '')));

        $jobs = array_values(array_filter(
            $this->jobListings(),
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

    private function jobListings(): array
    {
        return [
            [
                'company' => 'Sigma Course',
                'position' => 'Designer Graphic',
                'education' => 'SMA/SMK',
                'age' => 25,
                'needed' => 3,
                'location' => 'Pontianak',
                'category' => 'Design UI/UX',
                'logo' => 'ΣSIGMA',
                'logoClass' => 'text-blue-900',
                'image' => null,
            ],
            [
                'company' => "McDonald's Pontianak",
                'position' => 'Kasir',
                'education' => 'SMA/SMK',
                'age' => 35,
                'needed' => 2,
                'location' => 'Pontianak',
                'category' => 'Pelayanan',
                'logo' => 'M',
                'logoClass' => 'text-red-600',
                'image' => 'mcd.jpg',
            ],
            [
                'company' => "Hotway's - Part time",
                'position' => 'Pelayan',
                'education' => 'SMA/SMK',
                'age' => 24,
                'needed' => 4,
                'location' => 'Pontianak',
                'category' => 'Pelayanan',
                'logo' => "HOTWAY'S",
                'logoClass' => 'text-white',
                'image' => null,
            ],
            [
                'company' => 'Ayam Budi',
                'position' => 'Koki',
                'education' => 'D1 Tata Boga',
                'age' => 45,
                'needed' => 1,
                'location' => 'Pontianak',
                'category' => 'Pelayanan',
                'logo' => 'AYAM BUDI',
                'logoClass' => 'text-white',
                'image' => 'ayam budi.jpg',
            ],
            [
                'company' => 'PT Papasari',
                'position' => 'Staff Listrik',
                'education' => 'S1 Elektro',
                'age' => 50,
                'needed' => 2,
                'location' => 'Pontianak',
                'category' => 'Teknik',
                'logo' => 'PT PAPASARI',
                'logoClass' => 'text-blue-800',
                'image' => 'papasari.png',
            ],
            [
                'company' => 'Teazzi Ptk - Part time',
                'position' => 'Barista',
                'education' => 'SMA/SMK',
                'age' => 27,
                'needed' => 2,
                'location' => 'Pontianak',
                'category' => 'Pelayanan',
                'logo' => 'teazzi',
                'logoClass' => 'text-gray-900',
                'image' => 'teazzi.png',
            ],
            [
                'company' => 'Pertamina Sur Jaw',
                'position' => 'Operator SPBU',
                'education' => 'SMA/SMK',
                'age' => 26,
                'needed' => 2,
                'location' => 'Pontianak',
                'category' => 'Operasional',
                'logo' => 'PERTAMINA',
                'logoClass' => 'text-black',
                'image' => null,
            ],
            [
                'company' => 'BCA Jakarta Pusat',
                'position' => 'Data Analisis',
                'education' => 'S3 Informatika',
                'age' => 45,
                'needed' => 1,
                'location' => 'Jakarta Pusat',
                'category' => 'Data Analytic',
                'logo' => 'BCA',
                'logoClass' => 'text-blue-700',
                'image' => null,
            ],
        ];
    }
}
