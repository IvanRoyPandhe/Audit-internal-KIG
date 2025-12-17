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
            // Tujuan audit
            $table->text('audit_objective')->nullable()->after('description')->comment('Tujuan audit');
            
            // Auditor / Pelaksana
            $table->foreignId('team_leader_id')->nullable()->after('created_by')->constrained('users')->comment('Ketua tim auditor');
            $table->json('team_members')->nullable()->after('team_leader_id')->comment('Anggota tim auditor (array user IDs)');
            
            // Risiko
            $table->string('risk_name')->nullable()->after('team_members')->comment('Nama risiko');
            $table->enum('risk_level', ['low', 'medium', 'high', 'critical'])->nullable()->after('risk_name')->comment('Level risiko');
            
            // Untuk memastikan
            $table->text('assurance_scope')->nullable()->after('risk_level')->comment('Untuk memastikan (scope assurance)');
            
            $table->index('team_leader_id');
            $table->index('risk_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audit_programs', function (Blueprint $table) {
            $table->dropForeign(['team_leader_id']);
            $table->dropIndex(['team_leader_id']);
            $table->dropIndex(['risk_level']);
            $table->dropColumn([
                'audit_objective',
                'team_leader_id',
                'team_members',
                'risk_name',
                'risk_level',
                'assurance_scope'
            ]);
        });
    }
};
