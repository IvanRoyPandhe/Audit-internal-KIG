<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditProgram extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'audit_timeline_id',
        'program_code',
        'program_name',
        'description',
        'audit_objective',
        'team_leader_id',
        'team_members',
        'risks',
        'assurance_scope',
        'status',
        'created_by',
        'start_date',
        'end_date',
        'total_questions',
        'answered_questions',
        'closed_questions',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'team_members' => 'array',
        'risks' => 'array',
    ];

    public function auditTimeline(): BelongsTo
    {
        return $this->belongsTo(AuditTimeline::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function auditQuestions(): HasMany
    {
        return $this->hasMany(AuditQuestion::class);
    }

    public function teamLeader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'team_leader_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(AuditProgramDocument::class);
    }

    /**
     * Get team members as User collection
     */
    public function getTeamMembersUsersAttribute()
    {
        if (empty($this->team_members)) {
            return collect();
        }
        return User::whereIn('id', $this->team_members)->get();
    }
}
