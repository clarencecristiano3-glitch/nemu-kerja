<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $now = now();
        $companies = [
            [1, 'Sigma Course', 'sigma-course', 'Sigma Course', 'Pontianak', 'Sigma Course', 1, null],
            [2, "McDonald's", 'mcdonalds', 'PT Rekso Nasional Food', 'Indonesia', 'PT Rekso Nasional Food', 314, 'images/mcd.jpg'],
            [3, "Hotway's Chicken", 'hotways-chicken', 'PT Lingga Jaya Utama', 'Kalimantan Barat', 'PT Lingga Jaya Utama', 3, 'images/hotway_chicken.png'],
            [4, 'Ayam Budi', 'ayam-budi', 'Ayam Budi', 'Pontianak', 'Setyo Budi', 6, 'images/ayam budi.jpg'],
            [5, 'PT Papasari', 'pt-papasari', 'PT Papasari', 'Pontianak & Jakarta', 'Soewito Limin', 2, 'images/papasari.png'],
            [6, 'Teazzi', 'teazzi', 'PT Belly Yummy Foods', 'Pontianak', 'PT Belly Yummy Foods', 1, 'images/teazzi.png'],
            [7, 'Pertamina', 'pertamina', 'Pertamina Sur Jaw', 'Pontianak', 'Pertamina Sur Jaw', 1, null],
            [8, 'BCA', 'bca', 'BCA', 'Jakarta Pusat', 'BCA', 1, null],
            [9, 'Jojo Juice', 'jojo-juice', 'Jojo Juice', 'Pontianak', 'PT Lingga Jaya Utama', 1, 'images/jojo_juice.png'],
            [10, 'YSL', 'ysl', 'YSL', 'Pontianak', 'PT Lingga Jaya Utama', 1, 'images/ysl.png'],
        ];

        foreach ($companies as [$id, $name, $slug, $legalName, $region, $ownerName, $outlets, $logoPath]) {
            DB::table('companies')->insert([
                'id' => $id,
                'name' => $name,
                'slug' => $slug,
                'legal_name' => $legalName,
                'region' => $region,
                'owner_name' => $ownerName,
                'outlets_count' => $outlets,
                'logo_path' => $logoPath,
                'verification_status' => 'approved',
                'verified_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $vacancies = [
            [1, 1, 'Sigma Course - Designer Graphic', 'Designer Graphic', 'Full time', 'Design UI/UX', 'SMA/SMK', 25, 3, 3, 'Pontianak', 'Pontianak'],
            [2, 2, "McDonald's - Kasir", 'Kasir', 'Part time', 'Pelayanan', 'SMA/SMK', 35, 2, 10, 'Pontianak', 'Pontianak, Jl. Gajah Mada No. 123'],
            [3, 3, "Hotway's - Part time", 'Pelayan', 'Part time', 'Pelayanan', 'SMA/SMK', 24, 4, 10, 'Pontianak', 'Pontianak, Jl. Merdeka No 23'],
            [4, 4, 'Ayam Budi - Koki', 'Koki', 'Part time', 'Pelayanan', 'D1 Tata Boga', 45, 1, 10, 'Pontianak', 'Pontianak, Jalan Merdeka No 23'],
            [5, 5, 'PT Papasari - Staff Listrik', 'Staff Listrik', 'Full time', 'Teknik', 'S1 Elektro', 50, 2, 8, 'Pontianak', 'Pontianak'],
            [6, 6, 'Teazzi Ptk - Part time', 'Barista', 'Part time', 'Pelayanan', 'SMA/SMK', 27, 2, 8, 'Pontianak', 'Pontianak'],
            [7, 7, 'Pertamina Sur Jaw - Operator SPBU', 'Operator SPBU', 'Full time', 'Operasional', 'SMA/SMK', 26, 2, 8, 'Pontianak', 'Pontianak'],
            [8, 8, 'BCA Jakarta Pusat - Data Analisis', 'Data Analisis', 'Full time', 'Data Analytic', 'S3 Informatika', 45, 1, 10, 'Jakarta Pusat', 'Jakarta Pusat'],
            [9, 9, 'Jojo Juice - Part time', 'Pelayan', 'Part time', 'Pelayanan', 'SMA/SMK', 24, 2, 10, 'Pontianak', 'Pontianak, Jalan Merdeka No 23'],
            [10, 10, 'YSL - Full time', 'Pelayan', 'Full time', 'Pelayanan', 'SMA/SMK', 24, 2, 10, 'Pontianak', 'Pontianak, Jalan Merdeka No 23'],
        ];

        foreach ($vacancies as [$id, $companyId, $title, $position, $type, $category, $education, $age, $needed, $quota, $location, $address]) {
            DB::table('vacancies')->insert([
                'id' => $id,
                'company_id' => $companyId,
                'title' => $title,
                'position' => $position,
                'employment_type' => $type,
                'category' => $category,
                'minimum_education' => $education,
                'maximum_age' => $age,
                'needed' => $needed,
                'quota' => $quota,
                'location' => $location,
                'address' => $address,
                'description' => "Lowongan {$position} di {$title}.",
                'expires_at' => $now->copy()->addYear()->toDateString(),
                'status' => 'published',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('vacancies')->whereIn('id', range(1, 10))->delete();
        DB::table('companies')->whereIn('id', range(1, 10))->delete();
    }
};
