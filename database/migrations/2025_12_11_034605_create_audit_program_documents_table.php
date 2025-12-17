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
        Schema::create('audit_program_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_program_id')->constrained()->cascadeOnDelete()->comment('Program audit terkait');
            $table->string('document_name')->comment('Nama dokumen yang dibutuhkan');
            $table->text('description')->nullable()->comment('Deskripsi dokumen');
            $table->string('file_path')->nullable()->comment('Path file dokumen');
            $table->string('file_name')->nullable()->comment('Nama file asli');
            $table->string('file_type')->nullable()->comment('Tipe file (pdf, docx, xlsx, dll)');
            $table->integer('file_size')->nullable()->comment('Ukuran file dalam bytes');
            $table->enum('status', ['required', 'uploaded', 'reviewed', 'approved'])->default('required')->comment('Status dokumen');
            $table->boolean('is_mandatory')->default(true)->comment('Apakah dokumen wajib');
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->comment('User yang upload');
            $table->timestamp('uploaded_at')->nullable()->comment('Waktu upload');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->comment('User yang review');
            $table->timestamp('reviewed_at')->nullable()->comment('Waktu review');
            $table->text('review_notes')->nullable()->comment('Catatan review');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('status');
            $table->index('audit_program_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_program_documents');
    }
};
