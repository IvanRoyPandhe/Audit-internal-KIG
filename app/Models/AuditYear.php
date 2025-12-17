<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'description',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relationship to creator
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get timelines for this year
     */
    public function timelines()
    {
        return $this->hasMany(AuditTimeline::class, 'audit_year', 'year');
    }

    /**
     * Check if year has any data
     */
    public function hasData()
    {
        return $this->timelines()->count() > 0;
    }

    /**
     * Get timeline count
     */
    public function getTimelineCountAttribute()
    {
        return $this->timelines()->count();
    }

    /**
     * Get program count
     */
    public function getProgramCountAttribute()
    {
        return AuditProgram::whereHas('auditTimeline', function($q) {
            $q->where('audit_year', $this->year);
        })->count();
    }
}
