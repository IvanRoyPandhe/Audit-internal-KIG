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
        Schema::create('audit_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_question_id')->constrained()->cascadeOnDelete()->comment('Pertanyaan terkait');
            $table->foreignId('audit_answer_id')->nullable()->constrained()->cascadeOnDelete()->comment('Jawaban terkait');
            $table->string('document_name')->comment('Nama dokumen');
            $table->string('document_path')->comment('Path file dokumen');
            $table->string('document_type', 50)->comment('Tipe file (pdf, xlsx, docx, dll)');
            $table->integer('file_size')->comment('Ukuran file dalam bytes');
            $table->text('description')->nullable()->comment('Deskripsi dokumen');
            $table->foreignId('uploaded_by')->constrained('users')->comment('User yang upload');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->comment('Status dokumen');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete()->comment('Auditor yang review');
            $table->text('review_notes')->nullable()->comment('Catatan review');
            $table->timestamp('reviewed_at')->nullable()->comment('Waktu review');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['audit_question_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_documents');
    }
};
