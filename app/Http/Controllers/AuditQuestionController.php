<?php

namespace App\Http\Controllers;

use App\Models\AuditProgram;
use App\Models\AuditQuestion;
use App\Models\QuestionComment;
use Illuminate\Http\Request;

class AuditQuestionController extends Controller
{
    /**
     * Show question detail with comments and answers
     */
    public function show(AuditQuestion $question)
    {
        $question->load([
            'auditProgram.auditTimeline.department',
            'assignedTo',
            'auditAnswers.user',
            'auditAnswers.documents',
            'comments.user',
            'latestAnswer'
        ]);

        return view('audit-questions.show', compact('question'));
    }

    /**
     * Store new question
     */
    public function store(Request $request, AuditProgram $program)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'description' => 'nullable|string',
            'answer_type' => 'required|in:text,file,both',
            'is_required' => 'boolean',
            'required_documents' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        // Get next order number
        $lastOrder = $program->auditQuestions()->max('order_number') ?? 0;
        $validated['order_number'] = $lastOrder + 1;
        $validated['status'] = 'open';

        $question = $program->auditQuestions()->create($validated);

        // Update program total questions
        $program->increment('total_questions');

        return back()->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    /**
     * Update question
     */
    public function update(Request $request, AuditQuestion $question)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'description' => 'nullable|string',
            'answer_type' => 'required|in:text,file,both',
            'is_required' => 'boolean',
            'required_documents' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        $question->update($validated);

        return back()->with('success', 'Pertanyaan berhasil diupdate.');
    }

    /**
     * Update question status
     */
    public function updateStatus(Request $request, AuditQuestion $question)
    {
        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $oldStatus = $question->status;
        $question->update($validated);

        // Update program counters
        $program = $question->auditProgram;
        
        if ($oldStatus === 'closed' && $validated['status'] !== 'closed') {
            $program->decrement('closed_questions');
        } elseif ($oldStatus !== 'closed' && $validated['status'] === 'closed') {
            $program->increment('closed_questions');
        }

        return back()->with('success', 'Status pertanyaan berhasil diupdate.');
    }

    /**
     * Delete question
     */
    public function destroy(AuditQuestion $question)
    {
        $program = $question->auditProgram;
        
        // Check if question has answers
        if ($question->auditAnswers()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus pertanyaan yang sudah dijawab.');
        }

        $question->delete();

        // Update program total questions
        $program->decrement('total_questions');

        return back()->with('success', 'Pertanyaan berhasil dihapus.');
    }

    /**
     * Add comment to question
     */
    public function addComment(Request $request, AuditQuestion $question)
    {
        $validated = $request->validate([
            'comment' => 'required|string',
            'is_internal' => 'boolean',
        ]);

        $validated['user_id'] = auth()->id();

        $question->comments()->create($validated);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    /**
     * Delete comment
     */
    public function deleteComment(QuestionComment $comment)
    {
        // Only comment owner or admin can delete
        if ($comment->user_id !== auth()->id() && !auth()->user()->hasRole('admin')) {
            return back()->with('error', 'Anda tidak memiliki akses untuk menghapus komentar ini.');
        }

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
