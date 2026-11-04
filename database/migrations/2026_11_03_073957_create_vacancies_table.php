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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('position');
            $table->string('employment_type');
            $table->string('category');
            $table->string('minimum_education');
            $table->unsignedTinyInteger('maximum_age');
            $table->unsignedInteger('needed');
            $table->unsignedInteger('quota');
            $table->string('location');
            $table->string('address')->nullable();
            $table->text('description');
            $table->json('responsibilities')->nullable();
            $table->json('qualifications')->nullable();
            $table->json('schedule')->nullable();
            $table->json('benefits')->nullable();
            $table->date('expires_at')->nullable()->index();
            $table->string('status')->default('draft')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['company_id', 'status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
