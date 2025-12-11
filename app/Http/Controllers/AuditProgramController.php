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
        ]);

        // Generate program code
        $programCode = strtoupper($timeline->department->code) . '-' . $timeline->audit_year . '-' . Str::random(4);

        $program = $timeline->auditPrograms()->create([
            'program_code' => $programCode,
            'program_name' => $validated['program_name'],
            'description' => $validated['description'],
            'status' => 'draft',
            'created_by' => auth()->id(),
            'start_date' => $timeline->start_date,
            'end_date' => $timeline->end_date,
        ]);

        return redirect()->route('audit-programs.show', $program)
            ->with('success', 'Program audit berhasil dibuat. Silakan tambahkan pertanyaan audit.');
    }

    /**
     * Show program detail with questions
     */
    public function show(AuditProgram $program)
    {
        $program->load(['auditTimeline.department', 'auditQuestions', 'createdBy']);
        
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
