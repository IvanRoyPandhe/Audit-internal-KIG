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
        Schema::create('audit_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_question_id')->constrained()->cascadeOnDelete()->comment('Pertanyaan terkait');
            $table->foreignId('user_id')->constrained()->comment('User yang komen');
            $table->foreignId('parent_id')->nullable()->constrained('audit_comments')->cascadeOnDelete()->comment('Parent comment untuk reply');
            $table->text('comment')->comment('Isi komentar');
            $table->enum('comment_type', ['question', 'feedback', 'revision', 'general'])->default('general')->comment('Tipe komentar');
            $table->boolean('is_internal')->default(false)->comment('Komentar internal auditor (tidak terlihat auditee)');
            $table->boolean('is_read')->default(false)->comment('Status sudah dibaca');
            $table->timestamp('read_at')->nullable()->comment('Waktu dibaca');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['audit_question_id', 'created_at']);
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_comments');
    }
};
