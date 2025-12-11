<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TimelineTemplateExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    protected $departments;

    public function __construct($departments)
    {
        $this->departments = $departments;
    }

    public function collection()
    {
        return $this->departments->map(function ($dept) {
            return [
                $dept->code,
                $dept->name,
                '', // Format: YYYY-MM-DD contoh: 2025-01-15
                '', // Format: YYYY-MM-DD contoh: 2025-02-28
                'Ya', // Ya/Tidak
                '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Departemen',
            'Nama Departemen',
            'Tanggal Mulai YYYY-MM-DD',
            'Tanggal Selesai YYYY-MM-DD',
            'Aktif YaTidak',
            'Catatan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4']
                ],
                'font' => ['color' => ['rgb' => 'FFFFFF'], 'bold' => true],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 30,
            'C' => 25,
            'D' => 25,
            'E' => 20,
            'F' => 40,
        ];
    }
}
