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
     * Display year selection page (Entry Point)
     */
    public function yearSelection()
    {
        return view('rkia.year-selection');
    }

    /**
     * Display program menu for specific year
     */
    public function programByYear($year)
    {
        // Validate year
        if (!is_numeric($year) || $year < 2020 || $year > 2100) {
            return redirect()->route('rkia.program')->with('error', 'Tahun tidak valid');
        }

        // Get timelines with programs for this year
        $timelines = AuditTimeline::with([
                'department.seniorManager',
                'auditPrograms.auditQuestions'
            ])
            ->where('audit_year', $year)
            ->orderBy('start_date')
            ->get();

        return view('rkia.program', compact('timelines', 'year'));
    }

    /**
     * Display timeline list for specific year
     */
    public function timeline($year)
    {
        // Validate year
        if (!is_numeric($year) || $year < 2020 || $year > 2100) {
            return redirect()->route('rkia.program')->with('error', 'Tahun tidak valid');
        }

        $timelines = AuditTimeline::with(['department.seniorManager', 'createdBy'])
            ->where('audit_year', $year)
            ->orderBy('start_date')
            ->get();

        return view('rkia.timeline', compact('timelines', 'year'));
    }

    /**
     * Show create timeline form
     */
    public function createTimeline($year)
    {
        // Validate year
        if (!is_numeric($year) || $year < 2020 || $year > 2100) {
            return redirect()->route('rkia.program')->with('error', 'Tahun tidak valid');
        }

        $departments = Department::where('is_active', true)
            ->with('seniorManager')
            ->get();

        return view('rkia.timeline-create', compact('departments', 'year'));
    }

    /**
     * Store timeline
     */
    public function storeTimeline(Request $request, $year)
    {
        // Validate year
        if (!is_numeric($year) || $year < 2020 || $year > 2100) {
            return redirect()->route('rkia.program')->with('error', 'Tahun tidak valid');
        }

        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        // Check if timeline already exists for this department and year
        $exists = AuditTimeline::where('department_id', $validated['department_id'])
            ->where('audit_year', $year)
            ->exists();

        if ($exists) {
            return back()->withErrors(['department_id' => 'Timeline untuk departemen ini di tahun ' . $year . ' sudah ada.']);
        }

        $validated['audit_year'] = $year;
        $validated['created_by'] = auth()->id();
        $validated['is_active'] = $request->has('is_active');
        $validated['status'] = 'scheduled';

        $timeline = AuditTimeline::create($validated);

        // Send email notification to SM if active
        if ($timeline->is_active && $timeline->department->seniorManager) {
            // TODO: Implement email notification
            $timeline->update([
                'email_sent' => true,
                'email_sent_at' => now()
            ]);
        }

        return redirect()->route('rkia.program.year', $year)
            ->with('success', 'Timeline audit berhasil dibuat. Silakan lanjutkan dengan membuat program audit untuk departemen.');
    }

    /**
     * Show edit timeline form
     */
    public function editTimeline($year, AuditTimeline $timeline)
    {
        // Validate year matches timeline
        if ($timeline->audit_year != $year) {
            return redirect()->route('rkia.program')->with('error', 'Timeline tidak ditemukan untuk tahun ini');
        }

        $departments = Department::where('is_active', true)
            ->with('seniorManager')
            ->get();

        return view('rkia.timeline-edit', compact('timeline', 'departments', 'year'));
    }

    /**
     * Update timeline
     */
    public function updateTimeline(Request $request, $year, AuditTimeline $timeline)
    {
        // Validate year matches timeline
        if ($timeline->audit_year != $year) {
            return redirect()->route('rkia.program')->with('error', 'Timeline tidak ditemukan untuk tahun ini');
        }

        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'actual_start_date' => 'nullable|date',
            'actual_end_date' => 'nullable|date|after_or_equal:actual_start_date',
            'is_active' => 'boolean',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,ongoing,completed,cancelled',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $timeline->update($validated);

        return redirect()->route('rkia.timeline', $year)
            ->with('success', 'Timeline audit berhasil diupdate.');
    }

    /**
     * Delete timeline
     */
    public function destroyTimeline($year, AuditTimeline $timeline)
    {
        // Validate year matches timeline
        if ($timeline->audit_year != $year) {
            return redirect()->route('rkia.program')->with('error', 'Timeline tidak ditemukan untuk tahun ini');
        }

        // Check if timeline has programs
        if ($timeline->auditPrograms()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus timeline yang sudah memiliki program audit.');
        }

        $timeline->delete();

        return redirect()->route('rkia.timeline', $year)
            ->with('success', 'Timeline audit berhasil dihapus.');
    }

    /**
     * Download Excel template
     */
    public function downloadTemplate($year)
    {
        $departments = Department::where('is_active', true)
            ->orderBy('code')
            ->get(['id', 'code', 'name']);

        // Create Excel file
        return Excel::download(new \App\Exports\TimelineTemplateExport($departments), 'template-timeline-audit-' . $year . '.xlsx');
    }

    /**
     * Import timeline from Excel
     */
    public function importTimeline(Request $request, $year)
    {
        // Validate year
        if (!is_numeric($year) || $year < 2020 || $year > 2100) {
            return redirect()->route('rkia.program')->with('error', 'Tahun tidak valid');
        }

        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $import = new \App\Imports\TimelineImport($year, auth()->id());
            Excel::import($import, $request->file('file'));

            DB::commit();

            $count = $import->getRowCount();
            if ($count == 0) {
                return redirect()->route('rkia.program.year', $year)
                    ->with('error', 'Tidak ada timeline yang diimport. Pastikan ada departemen dengan checkbox TRUE di kolom Aktif dan tanggal sudah diisi.');
            }

            return redirect()->route('rkia.program.year', $year)
                ->with('success', 'Timeline berhasil diimport. Total: ' . $count . ' timeline. Silakan lanjutkan dengan membuat program audit untuk setiap departemen.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal import timeline: ' . $e->getMessage());
        }
    }

    /**
     * Display program audit list for specific year
     */
    public function programList($year)
    {
        // Validate year
        if (!is_numeric($year) || $year < 2020 || $year > 2100) {
            return redirect()->route('rkia.program')->with('error', 'Tahun tidak valid');
        }

        // Get timelines with programs
        $timelines = AuditTimeline::with([
                'department.seniorManager',
                'auditPrograms.auditQuestions'
            ])
            ->where('audit_year', $year)
            ->orderBy('start_date')
            ->get();

        return view('rkia.program-list', compact('timelines', 'year'));
    }
}
