<?php

namespace App\Http\Controllers;

use App\Models\AuditYear;
use Illuminate\Http\Request;

class AuditYearController extends Controller
{
    /**
     * Store new year
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:2020|max:2100|unique:audit_years,year',
            'description' => 'nullable|string|max:500',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['is_active'] = true;

        AuditYear::create($validated);

        return redirect()->route('rkia.program')
            ->with('success', 'Tahun audit ' . $validated['year'] . ' berhasil ditambahkan.');
    }

    /**
     * Delete year (only if no data)
     */
    public function destroy(AuditYear $auditYear)
    {
        // Check if year has any timeline data
        if ($auditYear->hasData()) {
            return back()->with('error', 'Tidak dapat menghapus tahun ' . $auditYear->year . ' karena sudah memiliki ' . $auditYear->timeline_count . ' timeline. Hapus semua timeline terlebih dahulu.');
        }

        $year = $auditYear->year;
        $auditYear->delete();

        return redirect()->route('rkia.program')
            ->with('success', 'Tahun audit ' . $year . ' berhasil dihapus.');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(AuditYear $auditYear)
    {
        $auditYear->update([
            'is_active' => !$auditYear->is_active
        ]);

        $status = $auditYear->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', 'Tahun audit ' . $auditYear->year . ' berhasil ' . $status . '.');
    }
}
