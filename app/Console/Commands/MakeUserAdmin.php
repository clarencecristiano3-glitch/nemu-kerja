<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:make-user-admin {username : Username akun yang akan dijadikan admin}')]
#[Description('Promote a registered user account to administrator')]
class MakeUserAdmin extends Command
{
    public function handle(): int
    {
        $user = User::query()->where('username', $this->argument('username'))->first();

        if ($user === null) {
            $this->error('Akun dengan username tersebut tidak ditemukan.');

            return self::FAILURE;
        }

        $user->forceFill(['role' => User::ROLE_ADMIN])->save();
        $this->info("{$user->username} sekarang memiliki role admin.");

        return self::SUCCESS;
    }
}
