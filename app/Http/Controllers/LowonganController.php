<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
    {
        $jobs = [
            [
                'id'             => 1,
                'company'        => "Hotway's Chicken",
                'type'           => "Part time",
                'image'          => "hotway_chicken.png",
                'location'       => "Pontianak, Jalan Merdeka No 23",
                'company_pt'     => "PT Lingga Jaya Utama",
                'position'       => "Pelayan",
                'education'      => "SMA/SMK",
                'age'            => 24,
                'applicants'     => 7,
                'max_applicants' => 10,
                'category'       => "Pelayanan",
            ],
            [
                'id'             => 2,
                'company'        => "Ayam Budi",
                'type'           => "Part time",
                'image'          => "ayam budi.jpg",
                'location'       => "Pontianak, Jalan Merdeka No 23",
                'company_pt'     => "PT Lingga Jaya Utama",
                'position'       => "Pelayan",
                'education'      => "SMA/SMK",
                'age'            => 24,
                'applicants'     => 8,
                'max_applicants' => 10,
                'category'       => "Pelayanan",
            ],
            [
                'id'             => 3,
                'company'        => "Jojo Juice",
                'type'           => "Part time",
                'image'          => "jojo_juice.png",
                'location'       => "Pontianak, Jalan Merdeka No 23",
                'company_pt'     => "PT Lingga Jaya Utama",
                'position'       => "Pelayan",
                'education'      => "SMA/SMK",
                'age'            => 24,
                'applicants'     => 4,
                'max_applicants' => 10,
                'category'       => "Pelayanan",
            ],
            [
                'id'             => 4,
                'company'        => "YSL",
                'type'           => "Full Time",
                'image'          => "ysl.png",
                'location'       => "Pontianak, Jalan Merdeka No 23",
                'company_pt'     => "PT Lingga Jaya Utama",
                'position'       => "Pelayan",
                'education'      => "SMA/SMK",
                'age'            => 24,
                'applicants'     => 7,
                'max_applicants' => 10,
                'category'       => "Pelayanan",
            ],
        ];

        return view('lowongan', compact('jobs'));
    }
}