<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class TimelineTemplateExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithEvents
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
                '', // Format: MM-DD contoh: 01-15 (15 Januari)
                '', // Format: MM-DD contoh: 02-28 (28 Februari)
                true, // Checkbox - default checked
                '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Departemen',
            'Nama Departemen',
            'Tanggal Mulai (MM-DD)',
            'Tanggal Selesai (MM-DD)',
            'Aktif (Centang untuk import)',
            'Catatan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $this->departments->count() + 1;
        
        return [
            // Header style
            1 => [
                'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            // Data rows
            'A2:F' . $lastRow => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC'],
                    ],
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 35,
            'C' => 28,
            'D' => 28,
            'E' => 20,
            'F' => 40,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $this->departments->count() + 1;

                // Add instruction row at the top
                $sheet->insertNewRowBefore(1, 3);
                
                // Merge cells for instructions
                $sheet->mergeCells('A1:F1');
                $sheet->mergeCells('A2:F2');
                $sheet->mergeCells('A3:F3');
                
                // Add instructions
                $sheet->setCellValue('A1', 'TEMPLATE IMPORT TIMELINE AUDIT');
                $sheet->setCellValue('A2', 'Petunjuk: Isi data timeline untuk setiap departemen. Kolom Kode dan Nama Departemen sudah terisi otomatis. TAHUN OTOMATIS sesuai tahun yang dipilih.');
                $sheet->setCellValue('A3', 'Format Tanggal: MM-DD (contoh: 01-15 untuk 15 Januari, 12-31 untuk 31 Desember). Kolom Aktif: Centang TRUE untuk import, FALSE untuk skip.');
                
                // Style instructions
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '1F4E78']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
                
                $sheet->getStyle('A2:A3')->applyFromArray([
                    'font' => ['size' => 10, 'italic' => true, 'color' => ['rgb' => '666666']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'wrapText' => true],
                ]);
                
                // Set row heights
                $sheet->getRowDimension(1)->setRowHeight(25);
                $sheet->getRowDimension(2)->setRowHeight(30);
                $sheet->getRowDimension(3)->setRowHeight(30);
                
                // Add checkboxes to "Aktif" column (E)
                $dataStartRow = 5; // After 3 instruction rows + 1 header row
                for ($row = $dataStartRow; $row <= ($lastRow + 3); $row++) {
                    $cellCoordinate = 'E' . $row;
                    
                    // Set cell value to TRUE (checked) by default
                    $sheet->setCellValue($cellCoordinate, true);
                    
                    // Apply checkbox style using formula
                    // Excel will display TRUE as checked checkbox, FALSE as unchecked
                    $sheet->getStyle($cellCoordinate)->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                        ->setVertical(Alignment::VERTICAL_CENTER);
                    
                    // Add data validation to ensure only TRUE/FALSE values
                    $validation = $sheet->getCell($cellCoordinate)->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST);
                    $validation->setErrorStyle(DataValidation::STYLE_STOP);
                    $validation->setAllowBlank(false);
                    $validation->setShowInputMessage(true);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Input Error');
                    $validation->setError('Pilih TRUE (centang) atau FALSE (tidak centang)');
                    $validation->setPromptTitle('Aktifkan Timeline');
                    $validation->setPrompt('Pilih TRUE untuk mengimport timeline, FALSE untuk skip');
                    $validation->setFormula1('"TRUE,FALSE"');
                }
                
                // Freeze header row
                $sheet->freezePane('A5');
                
                // Center align for specific columns
                $sheet->getStyle('A5:A' . ($lastRow + 3))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
