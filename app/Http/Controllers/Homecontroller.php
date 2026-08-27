<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = [
            [
                'name' => 'Web Developer',
                'icon' => 'browser'
            ],
            [
                'name' => 'Design UI/UX',
                'icon' => 'pen'
            ],
            [
                'name' => 'Data Analytic',
                'icon' => 'database'
            ],
            [
                'name' => 'Digital Marketing',
                'icon' => 'chart'
            ],
        ];

        $jobs = [
            [
                'company' => 'Sigma Course',
                'logo' => 'ΣSIGMA',
                'position' => 'Designer Graphic',
                'education' => 'SMA/SMK',
                'age' => 25,
                'needed' => 3,
                'location' => 'Pontianak',
                'category' => 'Design UI/UX',
                'style' => 'sigma'
            ],
            [
                'company' => "McDonald's Pontianak",
                'logo' => "McDonald's",
                'position' => 'Kasir',
                'education' => 'SMA/SMK',
                'age' => 35,
                'needed' => 2,
                'location' => 'Pontianak',
                'category' => 'Pelayanan',
                'style' => 'mcd'
            ],
            [
                'company' => "Hotway's - Part time",
                'logo' => "Hotway's",
                'position' => 'Pelayan',
                'education' => 'SMA/SMK',
                'age' => 24,
                'needed' => 4,
                'location' => 'Pontianak',
                'category' => 'Pelayanan',
                'style' => 'hotway'
            ],
            [
                'company' => 'Ayam Budi',
                'logo' => 'Ayam Budi',
                'position' => 'Koki',
                'education' => 'D1 Tata Boga',
                'age' => 45,
                'needed' => 1,
                'location' => 'Pontianak',
                'category' => 'Pelayanan',
                'style' => 'ayam'
            ],
            [
                'company' => 'PT Papasari',
                'logo' => 'PT PAPASARI',
                'position' => 'Staff Listrik',
                'education' => 'S1 Elektro',
                'age' => 50,
                'needed' => 2,
                'location' => 'Pontianak',
                'category' => 'Teknik',
                'style' => 'papasari'
            ],
            [
                'company' => 'Teazzi Ptk - Part time',
                'logo' => 'teazzi',
                'position' => 'Barista',
                'education' => 'SMA/SMK',
                'age' => 27,
                'needed' => 2,
                'location' => 'Pontianak',
                'category' => 'Pelayanan',
                'style' => 'teazzi'
            ],
            [
                'company' => 'Pertamina Sur Jaw',
                'logo' => 'PERTAMINA',
                'position' => 'Operator SPBU',
                'education' => 'SMA/SMK',
                'age' => 26,
                'needed' => 2,
                'location' => 'Pontianak',
                'category' => 'Operasional',
                'style' => 'pertamina'
            ],
            [
                'company' => 'BCA Jakarta Pusat',
                'logo' => 'BCA',
                'position' => 'Data Analisis',
                'education' => 'S3 Informatika',
                'age' => 45,
                'needed' => 1,
                'location' => 'Jakarta Pusat',
                'category' => 'Data Analytic',
                'style' => 'bca'
            ],
        ];

        return view('home', compact('categories', 'jobs'));
    }
}