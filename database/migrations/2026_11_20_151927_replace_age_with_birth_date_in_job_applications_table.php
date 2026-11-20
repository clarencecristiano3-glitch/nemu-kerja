<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_applications', function (Blueprint $table): void {
            $table->date('birth_date')->nullable()->after('full_name');
        });

        foreach (DB::table('job_applications')->select(['id', 'age'])->get() as $application) {
            if ($application->age !== null) {
                DB::table('job_applications')
                    ->where('id', $application->id)
                    ->update(['birth_date' => now()->subYears((int) $application->age)->toDateString()]);
            }
        }

        Schema::table('job_applications', function (Blueprint $table): void {
            $table->dropColumn('age');
        });
    }

    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table): void {
            $table->unsignedTinyInteger('age')->nullable()->after('full_name');
        });

        foreach (DB::table('job_applications')->select(['id', 'birth_date'])->get() as $application) {
            $age = $application->birth_date === null
                ? null
                : (int) now()->diffInYears($application->birth_date);

            DB::table('job_applications')->where('id', $application->id)->update(['age' => $age]);
        }

        Schema::table('job_applications', function (Blueprint $table): void {
            $table->dropColumn('birth_date');
        });
    }
};
