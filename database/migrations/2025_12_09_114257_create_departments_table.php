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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique()->comment('Kode departemen');
            $table->string('name')->comment('Nama departemen');
            $table->text('description')->nullable()->comment('Deskripsi departemen');
            $table->foreignId('sm_user_id')->nullable()->constrained('users')->nullOnDelete()->comment('Senior Manager departemen');
            $table->boolean('is_active')->default(true)->comment('Status aktif departemen');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
