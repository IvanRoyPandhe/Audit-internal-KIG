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
        Schema::create('audit_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_program_id')->constrained()->cascadeOnDelete()->comment('Program audit terkait');
            $table->integer('order_number')->comment('Nomor urut pertanyaan');
            $table->string('question_code', 50)->nullable()->comment('Kode pertanyaan');
            $table->text('question')->comment('Pertanyaan audit');
            $table->text('description')->nullable()->comment('Deskripsi/penjelasan pertanyaan');
            $table->enum('question_type', ['text', 'file', 'both'])->default('both')->comment('Tipe jawaban yang dibutuhkan');
            $table->enum('status', ['open', 'in_progress', 'closed'])->default('open')->comment('Status pertanyaan');
            $table->boolean('is_required')->default(true)->comment('Wajib dijawab');
            $table->boolean('requires_document')->default(false)->comment('Memerlukan dokumen');
            $table->string('document_type')->nullable()->comment('Tipe dokumen yang dibutuhkan');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete()->comment('User yang ditugaskan');
            $table->timestamp('answered_at')->nullable()->comment('Waktu dijawab');
            $table->timestamp('closed_at')->nullable()->comment('Waktu closed');
            $table->foreignId('closed_by')->nullable()->constrained('users')->nullOnDelete()->comment('Auditor yang close');
            $table->text('closure_notes')->nullable()->comment('Catatan penutupan');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['audit_program_id', 'status']);
            $table->index('order_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_questions');
    }
};
