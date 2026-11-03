<?php

namespace App\Support;

class JobListings
{
    public const DEFAULT_ID = 3;

    public static function featured(): array
    {
        return array_slice(self::all(), 0, 8);
    }

    public static function management(): array
    {
        return array_values(array_filter(
            self::all(),
            static fn (array $job): bool => in_array($job['id'], [3, 4, 9, 10], true),
        ));
    }

    public static function find(int $id): ?array
    {
        foreach (self::all() as $job) {
            if ($job['id'] === $id) {
                return [...$job, ...self::detailsFor($job)];
            }
        }

        return null;
    }

    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'company' => 'Sigma Course',
                'brand' => 'Sigma Course',
                'title' => 'Sigma Course - Designer Graphic',
                'type' => 'Full time',
                'position' => 'Designer Graphic',
                'education' => 'SMA/SMK',
                'age' => 25,
                'needed' => 3,
                'location' => 'Pontianak',
                'company_location' => 'Pontianak',
                'company_pt' => 'Sigma Course',
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
                'brand' => "McDonald's",
                'title' => "McDonald's - Kasir",
                'type' => 'Part time',
                'position' => 'Kasir',
                'education' => 'SMA/SMK',
                'age' => 35,
                'needed' => 2,
                'location' => 'Pontianak',
                'company_location' => 'Pontianak, Jl. Gajah Mada No. 123',
                'company_pt' => 'PT Rekso Nasional Food',
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
                'brand' => "Hotway's",
                'title' => "Hotway's - Part time",
                'type' => 'Part time',
                'position' => 'Pelayan',
                'education' => 'SMA/SMK',
                'age' => 24,
                'needed' => 4,
                'location' => 'Pontianak',
                'company_location' => 'Pontianak, Jl. Merdeka No 23',
                'company_pt' => 'PT Lingga Jaya Utama',
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
                'brand' => 'Ayam Budi',
                'title' => 'Ayam Budi - Koki',
                'type' => 'Part time',
                'position' => 'Koki',
                'education' => 'D1 Tata Boga',
                'age' => 45,
                'needed' => 1,
                'location' => 'Pontianak',
                'company_location' => 'Pontianak, Jalan Merdeka No 23',
                'company_pt' => 'Ayam Budi',
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
                'brand' => 'PT Papasari',
                'title' => 'PT Papasari - Staff Listrik',
                'type' => 'Full time',
                'position' => 'Staff Listrik',
                'education' => 'S1 Elektro',
                'age' => 50,
                'needed' => 2,
                'location' => 'Pontianak',
                'company_location' => 'Pontianak',
                'company_pt' => 'PT Papasari',
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
                'brand' => 'Teazzi',
                'title' => 'Teazzi Ptk - Part time',
                'type' => 'Part time',
                'position' => 'Barista',
                'education' => 'SMA/SMK',
                'age' => 27,
                'needed' => 2,
                'location' => 'Pontianak',
                'company_location' => 'Pontianak',
                'company_pt' => 'Teazzi',
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
                'brand' => 'Pertamina',
                'title' => 'Pertamina Sur Jaw - Operator SPBU',
                'type' => 'Full time',
                'position' => 'Operator SPBU',
                'education' => 'SMA/SMK',
                'age' => 26,
                'needed' => 2,
                'location' => 'Pontianak',
                'company_location' => 'Pontianak',
                'company_pt' => 'Pertamina Sur Jaw',
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
                'brand' => 'BCA',
                'title' => 'BCA Jakarta Pusat - Data Analisis',
                'type' => 'Full time',
                'position' => 'Data Analisis',
                'education' => 'S3 Informatika',
                'age' => 45,
                'needed' => 1,
                'location' => 'Jakarta Pusat',
                'company_location' => 'Jakarta Pusat',
                'company_pt' => 'BCA',
                'category' => 'Data Analytic',
                'logo' => 'BCA',
                'logoClass' => 'text-blue-700',
                'image' => null,
                'applicants' => 6,
                'quota' => 10,
                'remaining_days' => 12,
            ],
            [
                'id' => 9,
                'company' => 'Jojo Juice',
                'brand' => 'Jojo Juice',
                'title' => 'Jojo Juice - Part time',
                'type' => 'Part time',
                'position' => 'Pelayan',
                'education' => 'SMA/SMK',
                'age' => 24,
                'needed' => 2,
                'location' => 'Pontianak',
                'company_location' => 'Pontianak, Jalan Merdeka No 23',
                'company_pt' => 'PT Lingga Jaya Utama',
                'category' => 'Pelayanan',
                'logo' => 'Jojo Juice',
                'logoClass' => 'text-blue-800',
                'image' => 'jojo_juice.png',
                'applicants' => 4,
                'quota' => 10,
                'remaining_days' => 9,
            ],
            [
                'id' => 10,
                'company' => 'YSL',
                'brand' => 'YSL',
                'title' => 'YSL - Full time',
                'type' => 'Full time',
                'position' => 'Pelayan',
                'education' => 'SMA/SMK',
                'age' => 24,
                'needed' => 2,
                'location' => 'Pontianak',
                'company_location' => 'Pontianak, Jalan Merdeka No 23',
                'company_pt' => 'PT Lingga Jaya Utama',
                'category' => 'Pelayanan',
                'logo' => 'YSL',
                'logoClass' => 'text-black',
                'image' => 'ysl.png',
                'applicants' => 7,
                'quota' => 10,
                'remaining_days' => 10,
            ],
        ];
    }

    private static function detailsFor(array $job): array
    {
        return match ($job['category']) {
            'Design UI/UX' => [
                'responsibilities' => [
                    'Membuat materi visual dan desain digital sesuai kebutuhan proyek.',
                    'Mengembangkan konsep desain berdasarkan arahan dan identitas brand.',
                    'Menyiapkan revisi serta file desain untuk kebutuhan publikasi.',
                    'Berkolaborasi dengan tim untuk memastikan hasil desain sesuai brief.',
                ],
                'qualifications' => [
                    'Memiliki ketertarikan pada desain grafis dan komunikasi visual.',
                    'Mampu menggunakan perangkat lunak desain yang relevan.',
                    'Teliti, kreatif, dan dapat bekerja dengan tenggat waktu.',
                ],
                'schedule' => [
                    'Sistem kerja: '.$job['type'].'.',
                    'Jadwal kerja dan tenggat disepakati bersama tim.',
                ],
                'benefits' => [
                    'Kompensasi sesuai posisi dan pengalaman.',
                    'Kesempatan mengembangkan portofolio dan kemampuan desain.',
                ],
            ],
            'Teknik' => [
                'responsibilities' => [
                    'Melakukan pemeriksaan dan pemeliharaan instalasi listrik.',
                    'Membantu menangani gangguan teknis sesuai prosedur keselamatan.',
                    'Mencatat hasil pemeriksaan dan pekerjaan perawatan.',
                ],
                'qualifications' => [
                    'Memiliki pendidikan atau pengalaman yang sesuai bidang kelistrikan.',
                    'Memahami prosedur keselamatan kerja.',
                    'Teliti, bertanggung jawab, dan mampu bekerja dalam tim.',
                ],
                'schedule' => [
                    'Sistem kerja: '.$job['type'].'.',
                    'Jadwal dan penugasan mengikuti kebutuhan operasional.',
                ],
                'benefits' => [
                    'Kompensasi sesuai posisi dan pengalaman.',
                    'Perlengkapan kerja dan pengembangan kemampuan teknis.',
                ],
            ],
            'Data Analytic' => [
                'responsibilities' => [
                    'Mengumpulkan, membersihkan, dan memeriksa data.',
                    'Menyusun laporan analisis untuk mendukung kebutuhan tim.',
                    'Menyajikan temuan data secara jelas dan terstruktur.',
                ],
                'qualifications' => [
                    'Memiliki latar belakang pendidikan yang sesuai bidang data.',
                    'Mampu mengolah data dan membuat laporan.',
                    'Analitis, teliti, dan mampu menyampaikan temuan dengan baik.',
                ],
                'schedule' => [
                    'Sistem kerja: '.$job['type'].'.',
                    'Jadwal kerja mengikuti kebijakan perusahaan.',
                ],
                'benefits' => [
                    'Kompensasi sesuai posisi dan pengalaman.',
                    'Kesempatan mengembangkan kemampuan analisis data.',
                ],
            ],
            'Operasional' => [
                'responsibilities' => [
                    'Melayani pelanggan sesuai standar operasional.',
                    'Melakukan pemeriksaan rutin dan pencatatan transaksi.',
                    'Menjaga kebersihan, keamanan, dan kelancaran area kerja.',
                ],
                'qualifications' => [
                    'Pendidikan minimal '.$job['education'].'.',
                    'Mampu berkomunikasi dengan baik dan bekerja dalam tim.',
                    'Disiplin, jujur, dan bersedia mengikuti prosedur kerja.',
                ],
                'schedule' => [
                    'Sistem kerja: '.$job['type'].'.',
                    'Bersedia bekerja sesuai jadwal operasional.',
                ],
                'benefits' => [
                    'Kompensasi sesuai posisi dan pengalaman.',
                    'Pelatihan serta tunjangan sesuai kebijakan perusahaan.',
                ],
            ],
            default => [
                'responsibilities' => [
                    'Melayani pelanggan dengan ramah dan profesional.',
                    'Menjalankan tugas sebagai '.$job['position'].' sesuai standar operasional.',
                    'Menjaga kebersihan, kerapian, dan kenyamanan area kerja.',
                    'Bekerja sama dengan tim untuk memastikan operasional berjalan lancar.',
                ],
                'qualifications' => [
                    'Pria atau wanita dengan usia maksimal '.$job['age'].' tahun.',
                    'Pendidikan minimal '.$job['education'].'.',
                    'Berpenampilan rapi, komunikatif, dan mampu bekerja dalam tim.',
                    'Jujur, bertanggung jawab, dan bersedia mengikuti jadwal kerja.',
                ],
                'schedule' => [
                    'Sistem kerja: '.$job['type'].'.',
                    'Jadwal kerja dan shift mengikuti kebutuhan operasional.',
                    'Bersedia bekerja pada akhir pekan atau hari libur bila diperlukan.',
                ],
                'benefits' => [
                    'Kompensasi sesuai posisi dan jam kerja.',
                    'Pelatihan sesuai standar perusahaan.',
                    'Tunjangan mengikuti kebijakan perusahaan.',
                ],
            ],
        };
    }
}
