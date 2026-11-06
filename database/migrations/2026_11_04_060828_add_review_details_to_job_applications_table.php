<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('job_applications', function (Blueprint $table): void {
            $table->string('status')->default('pending')->index();
            $table->foreignId('reviewed_by')->nullable()->after('user_id')->constrained('users')->nullOnDelete();
            $table->text('review_note')->nullable();
            $table->timestamp('reviewed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table): void {
            $table->dropForeign(['reviewed_by']);
            $table->dropIndex(['status']);
            $table->dropColumn(['status', 'reviewed_by', 'review_note', 'reviewed_at']);
        });
    }
};
