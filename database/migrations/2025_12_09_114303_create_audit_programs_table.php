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
        Schema::create('audit_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_timeline_id')->constrained()->cascadeOnDelete()->comment('Timeline audit terkait');
            $table->string('program_code', 50)->unique()->comment('Kode program audit');
            $table->string('program_name')->comment('Nama program audit');
            $table->text('description')->nullable()->comment('Deskripsi program');
            $table->enum('status', ['draft', 'active', 'completed'])->default('draft')->comment('Status program');
            $table->foreignId('created_by')->constrained('users')->comment('Auditor yang membuat program');
            $table->date('start_date')->nullable()->comment('Tanggal mulai program');
            $table->date('end_date')->nullable()->comment('Tanggal selesai program');
            $table->integer('total_questions')->default(0)->comment('Total pertanyaan');
            $table->integer('answered_questions')->default(0)->comment('Pertanyaan terjawab');
            $table->integer('closed_questions')->default(0)->comment('Pertanyaan closed');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_programs');
    }
};
