<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
       $categories = [
    [
        'name' => 'Web Developer',
        'icon' => 'IT.png'
    ],
    [
        'name' => 'Design UI/UX',
        'icon' => 'Design.png'
    ],
    [
        'name' => 'Data Analytic',
        'icon' => 'data.png'
    ],
    [
        'name' => 'Digital Marketing',
        'icon' => 'chart.png'
    ],
];

        $jobs = [
            [
                'company' => 'Sigma Course',
                'position' => 'Designer Graphic',
                'education' => 'SMA/SMK',
                'age' => 25,
                'needed' => 3,
                'location' => 'Pontianak',
                'category' => 'Design UI/UX',
                'logo' => 'ΣSIGMA',
                'logoClass' => 'text-blue-900'
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
                'logoClass' => 'text-red-600'
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
                'logoClass' => 'text-white'
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
                'logoClass' => 'text-white'
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
                'logoClass' => 'text-blue-800'
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
                'logoClass' => 'text-gray-900'
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
                'logoClass' => 'text-black'
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
                'logoClass' => 'text-blue-700'
            ],
        ];

        return view(
            'home',
            compact('categories', 'jobs')
        );
    }
}