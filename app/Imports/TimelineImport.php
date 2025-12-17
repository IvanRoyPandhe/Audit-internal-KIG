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
        return 5; // Skip instruction rows (3 rows) and header row (1 row)
    }

    public function model(array $row)
    {
        // Use array index instead of heading names
        // Column 0: Kode Departemen
        // Column 1: Nama Departemen
        // Column 2: Tanggal Mulai
        // Column 3: Tanggal Selesai
        // Column 4: Aktif (TRUE/FALSE checkbox)
        // Column 5: Catatan
        
        $departmentCode = trim($row[0] ?? '');
        $startDate = $row[2] ?? '';
        $endDate = $row[3] ?? '';
        $isActiveValue = $row[4] ?? false;
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

        // Parse is_active from checkbox value
        // Excel checkbox returns: TRUE, FALSE, 1, 0, "TRUE", "FALSE", "Ya", "Tidak"
        $isActive = $this->parseCheckboxValue($isActiveValue);

        // Only create if active
        if (!$isActive) {
            return null;
        }

        // Validate dates
        if (empty($startDate) || empty($endDate)) {
            throw new \Exception("Tanggal mulai dan selesai harus diisi untuk departemen {$departmentCode}.");
        }

        // Parse dates - support multiple formats
        try {
            $startDate = $this->parseDate($startDate, $departmentCode);
            $endDate = $this->parseDate($endDate, $departmentCode);
        } catch (\Exception $e) {
            throw new \Exception("Format tanggal tidak valid untuk departemen {$departmentCode}. " . $e->getMessage());
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

    /**
     * Parse date from various formats
     * Supports: MM-DD, YYYY-MM-DD, Excel serial number
     */
    private function parseDate($date, $departmentCode): string
    {
        // If Excel serial number
        if (is_numeric($date) && $date > 1000) {
            return Date::excelToDateTimeObject($date)->format('Y-m-d');
        }

        $dateStr = trim($date);

        // If format MM-DD (e.g., 01-15)
        if (preg_match('/^(\d{1,2})-(\d{1,2})$/', $dateStr, $matches)) {
            $month = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
            $day = str_pad($matches[2], 2, '0', STR_PAD_LEFT);
            return $this->auditYear . '-' . $month . '-' . $day;
        }

        // If format YYYY-MM-DD (backward compatibility)
        if (preg_match('/^\d{4}-\d{1,2}-\d{1,2}$/', $dateStr)) {
            return Carbon::parse($dateStr)->format('Y-m-d');
        }

        throw new \Exception("Gunakan format MM-DD (contoh: 01-15) atau YYYY-MM-DD");
    }

    /**
     * Parse checkbox value from Excel
     * Supports: TRUE, FALSE, 1, 0, "TRUE", "FALSE", "Ya", "Tidak", true, false
     */
    private function parseCheckboxValue($value): bool
    {
        // Handle boolean values
        if (is_bool($value)) {
            return $value;
        }

        // Handle numeric values
        if (is_numeric($value)) {
            return (int)$value === 1;
        }

        // Handle string values
        if (is_string($value)) {
            $value = strtolower(trim($value));
            return in_array($value, ['true', '1', 'ya', 'yes', 'y']);
        }

        // Default to false
        return false;
    }
}
