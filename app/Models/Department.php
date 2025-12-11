<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description',
        'sm_user_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the senior manager of the department
     */
    public function seniorManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sm_user_id');
    }

    /**
     * Get all users in the department
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all audit timelines for the department
     */
    public function auditTimelines(): HasMany
    {
        return $this->hasMany(AuditTimeline::class);
    }
}
