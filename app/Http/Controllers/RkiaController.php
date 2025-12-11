<?php

namespace App\Http\Controllers;

use App\Models\AuditTimeline;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class RkiaController extends Controller
{
    /**
     * Display timeline list
     */
    public function timeline(Request $request)
    {
        $year = $request->get('year', date('Y'));
        
        $timelines = AuditTimeline::with(['department.seniorManager', 'createdBy'])
            ->where('audit_year', $year)
            ->orderBy('start_date')
            ->get();

        $years = AuditTimeline::select('audit_year')
            ->distinct()
            ->orderByDesc('audit_year')
            ->pluck('audit_year');

        if ($years->isEmpty()) {
            $years = collect([date('Y')]);
        }

        return view('rkia.timeline', compact('timelines', 'years', 'year'));
    }

    /**
     * Show create timeline form
     */
    public function createTimeline()
    {
        $departments = Department::where('is_active', true)
            ->with('seniorManager')
            ->get();

        return view('rkia.timeline-create', compact('departments'));
    }

    /**
     * Store timeline
     */
    public function storeTimeline(Request $request)
    {
        $validated = $request->validate([
            'audit_year' => 'required|integer|min:2020|max:2100',
            'department_id' => 'required|exists:departments,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        // Check if timeline already exists for this department and year
        $exists = AuditTimeline::where('department_id', $validated['department_id'])
            ->where('audit_year', $validated['audit_year'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['department_id' => 'Timeline untuk departemen ini di tahun ' . $validated['audit_year'] . ' sudah ada.']);
        }

        $validated['created_by'] = auth()->id();
        $validated['is_active'] = $request->has('is_active');
        $validated['status'] = 'scheduled';

        $timeline = AuditTimeline::create($validated);

        // Send email notification to SM if active
        if ($timeline->is_active && $timeline->department->seniorManager) {
            // TODO: Implement email notification
            // Mail::to($timeline->department->seniorManager->email)->send(new AuditScheduleNotification($timeline));
            
            $timeline->update([
                'email_sent' => true,
                'email_sent_at' => now()
            ]);
        }

        return redirect()->route('rkia.timeline')
            ->with('success', 'Timeline audit berhasil dibuat.');
    }

    /**
     * Show edit timeline form
     */
    public function editTimeline(AuditTimeline $timeline)
    {
        $departments = Department::where('is_active', true)
            ->with('seniorManager')
            ->get();

        return view('rkia.timeline-edit', compact('timeline', 'departments'));
    }

    /**
     * Update timeline
     */
    public function updateTimeline(Request $request, AuditTimeline $timeline)
    {
        $validated = $request->validate([
            'audit_year' => 'required|integer|min:2020|max:2100',
            'department_id' => 'required|exists:departments,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,ongoing,completed,cancelled',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $timeline->update($validated);

        return redirect()->route('rkia.timeline')
            ->with('success', 'Timeline audit berhasil diupdate.');
    }

    /**
     * Delete timeline
     */
    public function destroyTimeline(AuditTimeline $timeline)
    {
        // Check if timeline has programs
        if ($timeline->auditPrograms()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus timeline yang sudah memiliki program audit.');
        }

        $timeline->delete();

        return redirect()->route('rkia.timeline')
            ->with('success', 'Timeline audit berhasil dihapus.');
    }

    /**
     * Download Excel template
     */
    public function downloadTemplate()
    {
        $departments = Department::where('is_active', true)
            ->orderBy('code')
            ->get(['id', 'code', 'name']);

        // Create Excel file
        return Excel::download(new \App\Exports\TimelineTemplateExport($departments), 'template-timeline-audit.xlsx');
    }

    /**
     * Import timeline from Excel
     */
    public function importTimeline(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
            'audit_year' => 'required|integer|min:2020|max:2100',
        ]);

        try {
            DB::beginTransaction();

            $import = new \App\Imports\TimelineImport($request->audit_year, auth()->id());
            Excel::import($import, $request->file('file'));

            DB::commit();

            $count = $import->getRowCount();
            if ($count == 0) {
                return redirect()->route('rkia.timeline')
                    ->with('error', 'Tidak ada timeline yang diimport. Pastikan ada departemen dengan status "Ya" di kolom Aktif dan tanggal sudah diisi.');
            }

            return redirect()->route('rkia.timeline')
                ->with('success', 'Timeline berhasil diimport. Total: ' . $count . ' timeline.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal import timeline: ' . $e->getMessage());
        }
    }

    /**
     * Display program list
     */
    public function program(Request $request)
    {
        $year = $request->get('year', date('Y'));

        $programs = AuditTimeline::with([
                'department.seniorManager',
                'auditPrograms.auditQuestions'
            ])
            ->where('audit_year', $year)
            ->where('is_active', true)
            ->orderBy('start_date')
            ->get();

        return view('rkia.program', compact('programs', 'year'));
    }
}
