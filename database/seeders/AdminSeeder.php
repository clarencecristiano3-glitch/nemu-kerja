<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $password = env('SUPERADMIN_PASSWORD');
 
        if (! is_string($password) || $password === '') {
            throw new RuntimeException('Set SUPERADMIN_PASSWORD in .env before seeding the superadmin account.');
        }

        $superadmin = User::query()->firstOrNew(['username' => 'superadmin']);
        $superadmin->forceFill([
            'name' => 'Superadmin',
            'email' => 'superadmin@nemu-kerja.local',
            'age' => 25,
            'password' => Hash::make($password),
            'role' => UserRole::Superadmin,
        ])->save();
    }
}
