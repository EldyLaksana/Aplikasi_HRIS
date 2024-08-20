<?php

namespace App\Exports;

use App\Models\Sakit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SakitExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithCustomStartCell, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $data;
    private static $rowNumber = 0;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'No',
            'No ID',
            'Departemen',
            'Nama',
            'Tanggal',
            'Keterangan',
        ];
    }

    public function map($sakit): array
    {
        return [
            ++self::$rowNumber,
            $sakit->no_id,
            $sakit->departemen,
            $sakit->nama,
            $sakit->tanggal,
            $sakit->keterangan,
        ];
    }

    public function title(): string
    {
        return 'Data Sakit';
    }

    public function startCell(): string
    {
        return 'A3';
    }

    // public function styles(Worksheet $sheet)
    // {
    //     $sheet->getStyle('A1:F1')->getFont()->setBold(true);
    //     $sheet->getStyle('A1:F1')->getFill()->setFillType('solid')->getStartColor()->setRGB('FFFF00');
    // }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->mergeCells('A1:F1');
                $event->sheet->setCellValue('A1', 'Laporan Data Sakit');
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ]
                ]);
                $event->sheet->getStyle('A3:F3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => 'FFFFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FF4F81BD',
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $dataRange = 'A3:F' . (3 + self::$rowNumber);
                $event->sheet->getStyle($dataRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ]
                    ],
                ]);
            }
        ];
    }
}
