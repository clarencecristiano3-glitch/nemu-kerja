<?php

namespace App\Support;

class JobListings
{
    public const DEFAULT_ID = 3;

    /**
     * @return list<array{
     *     id: int,
     *     company: string,
     *     title: string,
     *     brand: string,
     *     position: string,
     *     education: string,
     *     age: int,
     *     needed: int,
     *     location: string,
     *     category: string,
     *     logo: string,
     *     logoClass: string,
     *     image: string|null,
     *     applicants: int,
     *     quota: int,
     *     remaining_days: int
     * }>
     */
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'company' => 'Sigma Course',
                'title' => 'Sigma Course - Designer Graphic',
                'brand' => 'Sigma Course',
                'position' => 'Designer Graphic',
                'education' => 'SMA/SMK',
                'age' => 25,
                'needed' => 3,
                'location' => 'Pontianak',
                'category' => 'Design UI/UX',
                'logo' => 'ΣSIGMA',
                'logoClass' => 'text-blue-900',
                'image' => null,
                'applicants' => 2,
                'quota' => 3,
                'remaining_days' => 8,
            ],
            [
                'id' => 2,
                'company' => "McDonald's Pontianak",
                'title' => "McDonald's - Kasir",
                'brand' => "McDonald's",
                'position' => 'Kasir',
                'education' => 'SMA/SMK',
                'age' => 35,
                'needed' => 2,
                'location' => 'Pontianak',
                'category' => 'Pelayanan',
                'logo' => 'M',
                'logoClass' => 'text-red-600',
                'image' => 'mcd.jpg',
                'applicants' => 5,
                'quota' => 10,
                'remaining_days' => 6,
            ],
            [
                'id' => 3,
                'company' => "Hotway's - Part time",
                'title' => "Hotway's - Part time",
                'brand' => "Hotway's",
                'position' => 'Pelayan',
                'education' => 'SMA/SMK',
                'age' => 24,
                'needed' => 4,
                'location' => 'Pontianak',
                'category' => 'Pelayanan',
                'logo' => "HOTWAY'S",
                'logoClass' => 'text-white',
                'image' => 'hotway_chicken.png',
                'applicants' => 7,
                'quota' => 10,
                'remaining_days' => 6,
            ],
            [
                'id' => 4,
                'company' => 'Ayam Budi',
                'title' => 'Ayam Budi - Koki',
                'brand' => 'Ayam Budi',
                'position' => 'Koki',
                'education' => 'D1 Tata Boga',
                'age' => 45,
                'needed' => 1,
                'location' => 'Pontianak',
                'category' => 'Pelayanan',
                'logo' => 'AYAM BUDI',
                'logoClass' => 'text-white',
                'image' => 'ayam budi.jpg',
                'applicants' => 8,
                'quota' => 10,
                'remaining_days' => 7,
            ],
            [
                'id' => 5,
                'company' => 'PT Papasari',
                'title' => 'PT Papasari - Staff Listrik',
                'brand' => 'PT Papasari',
                'position' => 'Staff Listrik',
                'education' => 'S1 Elektro',
                'age' => 50,
                'needed' => 2,
                'location' => 'Pontianak',
                'category' => 'Teknik',
                'logo' => 'PT PAPASARI',
                'logoClass' => 'text-blue-800',
                'image' => 'papasari.png',
                'applicants' => 4,
                'quota' => 8,
                'remaining_days' => 10,
            ],
            [
                'id' => 6,
                'company' => 'Teazzi Ptk - Part time',
                'title' => 'Teazzi Ptk - Part time',
                'brand' => 'Teazzi',
                'position' => 'Barista',
                'education' => 'SMA/SMK',
                'age' => 27,
                'needed' => 2,
                'location' => 'Pontianak',
                'category' => 'Pelayanan',
                'logo' => 'teazzi',
                'logoClass' => 'text-gray-900',
                'image' => 'teazzi.png',
                'applicants' => 3,
                'quota' => 8,
                'remaining_days' => 9,
            ],
            [
                'id' => 7,
                'company' => 'Pertamina Sur Jaw',
                'title' => 'Pertamina Sur Jaw - Operator SPBU',
                'brand' => 'Pertamina',
                'position' => 'Operator SPBU',
                'education' => 'SMA/SMK',
                'age' => 26,
                'needed' => 2,
                'location' => 'Pontianak',
                'category' => 'Operasional',
                'logo' => 'PERTAMINA',
                'logoClass' => 'text-black',
                'image' => null,
                'applicants' => 4,
                'quota' => 8,
                'remaining_days' => 5,
            ],
            [
                'id' => 8,
                'company' => 'BCA Jakarta Pusat',
                'title' => 'BCA Jakarta Pusat - Data Analisis',
                'brand' => 'BCA',
                'position' => 'Data Analisis',
                'education' => 'S3 Informatika',
                'age' => 45,
                'needed' => 1,
                'location' => 'Jakarta Pusat',
                'category' => 'Data Analytic',
                'logo' => 'BCA',
                'logoClass' => 'text-blue-700',
                'image' => null,
                'applicants' => 6,
                'quota' => 10,
                'remaining_days' => 12,
            ],
        ];
    }

    public static function find(int $id): ?array
    {
        foreach (self::all() as $job) {
            if ($job['id'] === $id) {
                return $job;
            }
        }

        return null;
    }
}
