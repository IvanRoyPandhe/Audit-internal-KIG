<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditProgramDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'audit_program_id',
        'document_name',
        'description',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'status',
        'is_mandatory',
        'uploaded_by',
        'uploaded_at',
        'reviewed_by',
        'reviewed_at',
        'review_notes',
    ];

    protected $casts = [
        'is_mandatory' => 'boolean',
        'uploaded_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    /**
     * Relationship to audit program
     */
    public function auditProgram()
    {
        return $this->belongsTo(AuditProgram::class);
    }

    /**
     * Relationship to uploader
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Relationship to reviewer
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
