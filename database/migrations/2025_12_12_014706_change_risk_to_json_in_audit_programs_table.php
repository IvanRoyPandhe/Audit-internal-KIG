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
        Schema::table('audit_programs', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['risk_name', 'risk_level']);
            
            // Add new JSON column for multiple risks
            $table->json('risks')->nullable()->after('team_members')->comment('Array of risks: [{name, level}]');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audit_programs', function (Blueprint $table) {
            $table->dropColumn('risks');
            
            // Restore old columns
            $table->string('risk_name')->nullable()->after('team_members');
            $table->enum('risk_level', ['low', 'medium', 'high', 'critical'])->nullable()->after('risk_name');
        });
    }
};
