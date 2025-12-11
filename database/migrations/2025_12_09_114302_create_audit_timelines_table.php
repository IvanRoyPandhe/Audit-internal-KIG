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
        Schema::create('audit_timelines', function (Blueprint $table) {
            $table->id();
            $table->year('audit_year')->comment('Tahun audit');
            $table->foreignId('department_id')->constrained()->cascadeOnDelete()->comment('Departemen yang diaudit');
            $table->date('start_date')->comment('Tanggal mulai audit');
            $table->date('end_date')->comment('Tanggal selesai audit');
            $table->boolean('is_active')->default(true)->comment('Status aktif (departemen dapat jadwal audit)');
            $table->enum('status', ['scheduled', 'ongoing', 'completed', 'cancelled'])->default('scheduled')->comment('Status timeline');
            $table->foreignId('created_by')->constrained('users')->comment('Auditor yang membuat timeline');
            $table->text('notes')->nullable()->comment('Catatan tambahan');
            $table->boolean('email_sent')->default(false)->comment('Status email notifikasi sudah dikirim');
            $table->timestamp('email_sent_at')->nullable()->comment('Waktu email dikirim');
            $table->timestamps();
            $table->softDeletes();
            
            // Index untuk performa
            $table->index(['audit_year', 'department_id']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_timelines');
    }
};
