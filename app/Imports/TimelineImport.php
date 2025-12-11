<?php

namespace App\Imports;

use App\Models\AuditTimeline;
use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TimelineImport implements ToModel, WithStartRow
{
    protected $auditYear;
    protected $createdBy;
    protected $rowCount = 0;

    public function __construct($auditYear, $createdBy)
    {
        $this->auditYear = $auditYear;
        $this->createdBy = $createdBy;
    }

    public function startRow(): int
    {
        return 2; // Skip header row
    }

    public function model(array $row)
    {
        // Use array index instead of heading names
        // Column 0: Kode Departemen
        // Column 1: Nama Departemen
        // Column 2: Tanggal Mulai
        // Column 3: Tanggal Selesai
        // Column 4: Aktif (Ya/Tidak)
        // Column 5: Catatan
        
        $departmentCode = trim($row[0] ?? '');
        $startDate = trim($row[2] ?? '');
        $endDate = trim($row[3] ?? '');
        $isActiveValue = trim($row[4] ?? 'Tidak');
        $notes = trim($row[5] ?? '');
        
        // Skip if no department code
        if (empty($departmentCode)) {
            return null;
        }

        // Find department by code
        $department = Department::where('code', $departmentCode)->first();

        if (!$department) {
            throw new \Exception("Departemen dengan kode '{$departmentCode}' tidak ditemukan.");
        }

        // Check if already exists
        $exists = AuditTimeline::where('department_id', $department->id)
            ->where('audit_year', $this->auditYear)
            ->exists();

        if ($exists) {
            // Skip if already exists
            return null;
        }

        // Parse is_active
        $isActive = strtolower($isActiveValue) === 'ya';

        // Only create if active
        if (!$isActive) {
            return null;
        }

        // Validate dates
        if (empty($startDate) || empty($endDate)) {
            throw new \Exception("Tanggal mulai dan selesai harus diisi untuk departemen {$departmentCode}.");
        }

        // Convert Excel date serial number to Carbon date
        // Excel stores dates as numbers (e.g., 46000 = 2025-12-09)
        try {
            if (is_numeric($startDate)) {
                $startDate = Date::excelToDateTimeObject($startDate)->format('Y-m-d');
            }
            if (is_numeric($endDate)) {
                $endDate = Date::excelToDateTimeObject($endDate)->format('Y-m-d');
            }
        } catch (\Exception $e) {
            throw new \Exception("Format tanggal tidak valid untuk departemen {$departmentCode}. Gunakan format YYYY-MM-DD atau format tanggal Excel.");
        }

        $this->rowCount++;

        return new AuditTimeline([
            'audit_year' => $this->auditYear,
            'department_id' => $department->id,
            'start_date' => Carbon::parse($startDate),
            'end_date' => Carbon::parse($endDate),
            'is_active' => $isActive,
            'status' => 'scheduled',
            'created_by' => $this->createdBy,
            'notes' => !empty($notes) ? $notes : null,
            'email_sent' => false,
        ]);
    }

    public function getRowCount()
    {
        return $this->rowCount;
    }
}
