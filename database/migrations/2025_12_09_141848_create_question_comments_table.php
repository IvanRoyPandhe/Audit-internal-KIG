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
        Schema::create('question_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_question_id')->constrained()->cascadeOnDelete()->comment('Pertanyaan terkait');
            $table->foreignId('user_id')->constrained()->comment('User yang berkomentar');
            $table->text('comment')->comment('Isi komentar');
            $table->boolean('is_internal')->default(false)->comment('Komentar internal (hanya auditor)');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('audit_question_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_comments');
    }
};
