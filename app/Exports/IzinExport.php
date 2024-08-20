<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Izin;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class IzinExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithCustomStartCell, WithEvents
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
            'Izin',
            'Jam',
            'Alasan',
        ];
    }

    public function map($izin): array
    {
        return [
            ++self::$rowNumber,
            $izin->no_id,
            $izin->departemen,
            $izin->nama,
            Carbon::parse($izin->tanggal)->translatedFormat('d F Y'),
            $izin->izin,
            $izin->jam_selesai
                ? Carbon::parse($izin->jam)->format('H:i') . ' s/d ' . Carbon::parse($izin->jam_selesai)->format('H:i')
                : Carbon::parse($izin->jam)->format('H:i'),
            $izin->alasan,
        ];
    }

    // public function styles(Worksheet $sheet)
    // {
    //     $sheet->getStyle('A1:H1')->getFont()->setBold(true);
    //     $sheet->getStyle('A1:H1')->getFill()->setFillType('solid')->getStartColor()->setRGB('FFFF00');
    // }

    public function title(): string
    {
        return 'Data Izin';
    }

    public function startCell(): string
    {
        return 'A3';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->mergeCells('A1:H1');
                $event->sheet->setCellValue('A1', 'Laporan Data Izin');
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('A3:H3')->applyFromArray([
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

                $dataRange = 'A3:H' . (3 + self::$rowNumber);
                $event->sheet->getStyle($dataRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);
            }
        ];
    }
}
