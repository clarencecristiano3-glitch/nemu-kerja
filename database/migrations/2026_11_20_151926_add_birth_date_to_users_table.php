<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->date('birth_date')->nullable()->after('email');
        });

        foreach (DB::table('users')->select(['id', 'age'])->get() as $user) {
            if ($user->age !== null) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['birth_date' => now()->subYears((int) $user->age)->toDateString()]);
            }
        }

        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn('age');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->unsignedTinyInteger('age')->nullable()->after('email');
        });

        foreach (DB::table('users')->select(['id', 'birth_date'])->get() as $user) {
            $age = $user->birth_date === null
                ? null
                : (int) now()->diffInYears($user->birth_date);

            DB::table('users')->where('id', $user->id)->update(['age' => $age]);
        }

        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn('birth_date');
        });
    }
};
