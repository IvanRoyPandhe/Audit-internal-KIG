<?php

namespace App\Http\Controllers;

use App\Models\AuditProgram;
use App\Models\AuditProgramDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuditProgramDocumentController extends Controller
{
    /**
     * Store new document requirement
     */
    public function store(Request $request, AuditProgram $program)
    {
        $validated = $request->validate([
            'document_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_mandatory' => 'boolean',
        ]);

        $program->documents()->create([
            'document_name' => $validated['document_name'],
            'description' => $validated['description'] ?? null,
            'is_mandatory' => $request->has('is_mandatory'),
            'status' => 'required',
        ]);

        return back()->with('success', 'Dokumen berhasil ditambahkan ke daftar kebutuhan.');
    }

    /**
     * Upload document file
     */
    public function upload(Request $request, AuditProgramDocument $document)
    {
        $request->validate([
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
        ]);

        try {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('audit-documents', $fileName, 'public');

            $document->update([
                'file_path' => $filePath,
                'file_name' => $file->getClientOriginalName(),
                'file_type' => $file->getClientOriginalExtension(),
                'file_size' => $file->getSize(),
                'status' => 'uploaded',
                'uploaded_by' => auth()->id(),
                'uploaded_at' => now(),
            ]);

            return back()->with('success', 'File berhasil diupload.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal upload file: ' . $e->getMessage());
        }
    }

    /**
     * Download document
     */
    public function download(AuditProgramDocument $document)
    {
        if (!$document->file_path || !Storage::disk('public')->exists($document->file_path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }

    /**
     * Delete document
     */
    public function destroy(AuditProgramDocument $document)
    {
        // Delete file if exists
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }
}
