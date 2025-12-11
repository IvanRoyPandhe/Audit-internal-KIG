<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditTimeline extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'audit_year',
        'department_id',
        'start_date',
        'end_date',
        'is_active',
        'status',
        'created_by',
        'notes',
        'email_sent',
        'email_sent_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'email_sent' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'email_sent_at' => 'datetime',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function auditPrograms(): HasMany
    {
        return $this->hasMany(AuditProgram::class);
    }
}
