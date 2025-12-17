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
        Schema::create('audit_years', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->unique()->comment('Tahun audit');
            $table->text('description')->nullable()->comment('Deskripsi tahun audit');
            $table->boolean('is_active')->default(true)->comment('Status aktif');
            $table->foreignId('created_by')->constrained('users')->comment('User yang membuat');
            $table->timestamps();
            
            $table->index('year');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_years');
    }
};
