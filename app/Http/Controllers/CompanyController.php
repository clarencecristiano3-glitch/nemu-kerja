<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CompanyController extends Controller
{
    public function index(): View
    {
        $companies = [
            ['name' => 'Ayam Budi', 'region' => 'Kalimantan Barat', 'outlets' => 6, 'owner' => 'Setyo Budi', 'logo' => 'ayam budi.jpg'],
            ['name' => 'PT Papasari', 'region' => 'Pontianak & Jakarta', 'outlets' => 2, 'owner' => 'Soewito Limin', 'logo' => 'papasari.png'],
            ['name' => "McDonald's", 'region' => 'Indonesia', 'outlets' => 314, 'owner' => 'PT Rekso Nasional Food', 'logo' => 'mcd.jpg'],
            ['name' => 'Teazzi', 'region' => 'Pontianak', 'outlets' => 1, 'owner' => 'PT Belly Yummy Foods', 'logo' => 'teazzi.png'],
            ['name' => "Jims Honey", 'region' => 'Indonesia', 'outlets' => 80, 'owner' => 'Hanny Zeng', 'logo' => 'jims honey.png'],
            ['name' => 'Luuca', 'region' => 'Pontianak', 'outlets' => 4, 'owner' => 'PT Jar Andalan Rasa', 'logo' => 'luuca.png'],
            ['name' => "Ayam Geprek Siantan", 'region' => 'Indonesia', 'outlets' => 1, 'owner' => 'Orang Siantan', 'logo' => 'ayam geprek.jpg'],
            ['name' => 'Chikuro', 'region' => 'Indonesia', 'outlets' => 90, 'owner' => 'PT Chikuro Indoneisa Global', 'logo' => 'chikuro.png'],
        ];

        return view('company.index', compact('companies'));
    }
}