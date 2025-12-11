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
        Schema::create('audit_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_question_id')->constrained()->cascadeOnDelete()->comment('Pertanyaan terkait');
            $table->text('answer')->nullable()->comment('Jawaban dari auditee');
            $table->foreignId('answered_by')->constrained('users')->comment('User yang menjawab');
            $table->enum('answer_status', ['draft', 'submitted', 'revision', 'approved'])->default('draft')->comment('Status jawaban');
            $table->text('revision_notes')->nullable()->comment('Catatan revisi dari auditor');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete()->comment('Auditor yang review');
            $table->timestamp('submitted_at')->nullable()->comment('Waktu submit jawaban');
            $table->timestamp('reviewed_at')->nullable()->comment('Waktu review');
            $table->integer('revision_count')->default(0)->comment('Jumlah revisi');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['audit_question_id', 'answer_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_answers');
    }
};
