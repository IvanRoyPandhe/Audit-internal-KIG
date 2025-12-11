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
        Schema::create('audit_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_program_id')->constrained()->cascadeOnDelete()->comment('Program audit terkait');
            $table->string('report_number', 50)->unique()->comment('Nomor laporan');
            $table->string('report_title')->comment('Judul laporan');
            $table->date('report_date')->comment('Tanggal laporan');
            $table->text('executive_summary')->nullable()->comment('Ringkasan eksekutif');
            $table->text('audit_scope')->nullable()->comment('Ruang lingkup audit');
            $table->text('audit_methodology')->nullable()->comment('Metodologi audit');
            $table->text('findings')->nullable()->comment('Temuan audit (JSON)');
            $table->text('recommendations')->nullable()->comment('Rekomendasi');
            $table->text('conclusion')->nullable()->comment('Kesimpulan');
            $table->enum('status', ['draft', 'review', 'approved', 'published'])->default('draft')->comment('Status laporan');
            $table->foreignId('prepared_by')->constrained('users')->comment('Auditor yang menyusun');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete()->comment('Reviewer');
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete()->comment('Approver');
            $table->timestamp('reviewed_at')->nullable()->comment('Waktu review');
            $table->timestamp('approved_at')->nullable()->comment('Waktu approve');
            $table->timestamp('published_at')->nullable()->comment('Waktu publish');
            $table->string('pdf_path')->nullable()->comment('Path file PDF laporan');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('status');
            $table->index('report_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_reports');
    }
};
