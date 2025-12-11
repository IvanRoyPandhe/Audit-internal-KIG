<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditQuestion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'audit_program_id',
        'order_number',
        'question',
        'description',
        'answer_type',
        'is_required',
        'required_documents',
        'status',
        'assigned_to',
        'due_date',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'due_date' => 'date',
    ];

    public function auditProgram(): BelongsTo
    {
        return $this->belongsTo(AuditProgram::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function auditAnswers(): HasMany
    {
        return $this->hasMany(AuditAnswer::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(QuestionComment::class);
    }

    // Get latest answer
    public function latestAnswer()
    {
        return $this->hasOne(AuditAnswer::class)->latestOfMany();
    }
}
