<?php

namespace App\Http\Controllers;

use App\Models\AuditProgram;
use App\Models\AuditTimeline;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuditProgramController extends Controller
{
    /**
     * Show form to create program
     */
    public function create(AuditTimeline $timeline)
    {
        // Check if program already exists
        $existingProgram = $timeline->auditPrograms()->first();
        
        if ($existingProgram) {
            return redirect()->route('audit-programs.show', $existingProgram)
                ->with('info', 'Program audit untuk departemen ini sudah ada.');
        }

        return view('rkia.program-create', compact('timeline'));
    }

    /**
     * Store new program
     */
    public function store(Request $request, AuditTimeline $timeline)
    {
        $validated = $request->validate([
            'program_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'audit_objective' => 'required|string',
            'team_leader_id' => 'required|exists:users,id',
            'team_members' => 'nullable|array',
            'team_members.*' => 'exists:users,id',
            'risks' => 'required|array|min:1',
            'risks.*.name' => 'required|string|max:255',
            'risks.*.level' => 'required|in:low,medium,high,critical',
            'assurance_scope' => 'required|string',
        ]);

        // Generate program code
        $programCode = strtoupper($timeline->department->code) . '-' . $timeline->audit_year . '-' . Str::random(4);

        $program = $timeline->auditPrograms()->create([
            'program_code' => $programCode,
            'program_name' => $validated['program_name'],
            'description' => $validated['description'],
            'audit_objective' => $validated['audit_objective'],
            'team_leader_id' => $validated['team_leader_id'],
            'team_members' => $validated['team_members'] ?? [],
            'risks' => $validated['risks'],
            'assurance_scope' => $validated['assurance_scope'],
            'status' => 'draft',
            'created_by' => auth()->id(),
            'start_date' => $timeline->start_date,
            'end_date' => $timeline->end_date,
        ]);

        return redirect()->route('audit-programs.show', $program)
            ->with('success', 'Program audit berhasil dibuat. Silakan tambahkan dokumen yang dibutuhkan.');
    }

    /**
     * Show program detail with documents and questions
     */
    public function show(AuditProgram $program)
    {
        $program->load([
            'auditTimeline.department', 
            'auditQuestions', 
            'documents',
            'createdBy',
            'teamLeader'
        ]);
        
        return view('rkia.program-show', compact('program'));
    }

    /**
     * Update program
     */
    public function update(Request $request, AuditProgram $program)
    {
        $validated = $request->validate([
            'program_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,active,completed',
        ]);

        $program->update($validated);

        return back()->with('success', 'Program audit berhasil diupdate.');
    }

    /**
     * Delete program
     */
    public function destroy(AuditProgram $program)
    {
        // Check if program has questions
        if ($program->auditQuestions()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus program yang sudah memiliki pertanyaan.');
        }

        $program->delete();

        return redirect()->route('rkia.program')
            ->with('success', 'Program audit berhasil dihapus.');
    }
}
