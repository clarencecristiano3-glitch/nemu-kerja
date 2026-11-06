<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table): void {
            $table->foreignId('owner_id')->nullable()->after('id')->constrained('users')->nullOnDelete();
            $table->string('document_path')->nullable();
            $table->string('status')->default('pending')->index();
            $table->text('rejection_reason')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approval_notified_at')->nullable();
        });

        DB::table('companies')->update([
            'status' => 'verified',
            'verification_status' => 'approved',
            'verified_at' => DB::raw('COALESCE(verified_at, CURRENT_TIMESTAMP)'),
        ]);

        DB::table('users')->where('role', 'admin')->update(['role' => 'user']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table): void {
            $table->dropForeign(['owner_id']);
            $table->dropForeign(['verified_by']);
            $table->dropIndex(['status']);
            $table->dropColumn([
                'owner_id',
                'document_path',
                'status',
                'rejection_reason',
                'verified_by',
                'approval_notified_at',
            ]);
        });
    }
};
