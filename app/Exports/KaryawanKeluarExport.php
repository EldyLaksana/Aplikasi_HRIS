<?php

namespace App\Exports;

use App\Models\KaryawanKeluar;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KaryawanKeluarExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithCustomStartCell, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private static $rowNumber = 0;

    public function collection()
    {
        return KaryawanKeluar::all();
    }

    public function headings(): array
    {
        return [
            // 'No ID',
            // 'Departemen',
            // 'Nama',
            // 'Tempat',
            // 'Tanggal Lahir',
            // 'Telepon',
            // 'Email',
            // 'Alamat',
            // 'NIK',
            // 'Pendidikan',
            // 'Agama',
            // 'Emergency 1',
            // 'Status',
            // 'Telepon',
            // 'Emergency 2',
            // 'Status',
            // 'Telepon',
            'No',
            'No ID',
            'Departemen',
            'Jabatan',
            'Status Pegawai',
            'Tanggal Masuk',
            'Tanggal Keluar',
            'Nama',
            'NIK',
            'No KK',
            'BPJS Kesehatan',
            'BPJS Ketenagakerjaan',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Agama',
            'Pendidikan',
            'Alamat',
            'Telepon',
            'Email',
            'Facebook',
            'Instagram',
            'TikTok',
            'X',
            'Emergency 1',
            'Status',
            'Telepon',
            'Emergency 2',
            'Status',
            'Telepon',
        ];
    }

    public function map($karyawanKeluar): array
    {
        return [
            // $karyawanKeluar->no_id,
            // $karyawanKeluar->departemen->departemen,
            // $karyawanKeluar->nama,
            // $karyawanKeluar->tempat_lahir,
            // Carbon::parse($karyawanKeluar->tanggal_lahir)->translatedFormat('d F Y'),
            // $karyawanKeluar->telepon,
            // $karyawanKeluar->email,
            // $karyawanKeluar->alamat,
            // $karyawanKeluar->ktp,
            // $karyawanKeluar->pendidikan,
            // $karyawanKeluar->agama,
            // $karyawanKeluar->nama1,
            // $karyawanKeluar->status1,
            // $karyawanKeluar->telepon1,
            // $karyawanKeluar->nama2,
            // $karyawanKeluar->status2,
            // $karyawanKeluar->telepon2,
            ++self::$rowNumber,
            $karyawanKeluar->no_id,
            $karyawanKeluar->departemen->departemen,
            $karyawanKeluar->jabatan,
            $karyawanKeluar->status_pegawai,
            Carbon::parse($karyawanKeluar->tanggal_masuk)->translatedFormat('d F Y'),
            Carbon::parse($karyawanKeluar->created_at)->translatedFormat('d F Y'),
            $karyawanKeluar->nama,
            $karyawanKeluar->ktp,
            $karyawanKeluar->kk,
            $karyawanKeluar->bpjs_kesehatan,
            $karyawanKeluar->bpjs_ketenagakerjaan,
            $karyawanKeluar->jenis_kelamin,
            $karyawanKeluar->tempat_lahir,
            Carbon::parse($karyawanKeluar->tanggal_lahir)->translatedFormat('d F Y'),
            $karyawanKeluar->agama,
            $karyawanKeluar->pendidikan,
            $karyawanKeluar->alamat,
            $karyawanKeluar->telepon,
            $karyawanKeluar->email,
            $karyawanKeluar->facebook,
            $karyawanKeluar->instagram,
            $karyawanKeluar->tiktok,
            $karyawanKeluar->x,
            $karyawanKeluar->nama1,
            $karyawanKeluar->status1,
            $karyawanKeluar->telepon1,
            $karyawanKeluar->nama2,
            $karyawanKeluar->status2,
            $karyawanKeluar->telepon2,
        ];
    }

    // public function styles(Worksheet $sheet)
    // {
    //     $sheet->getStyle('A1:AC1')->getFont()->setBold(true);
    //     $sheet->getStyle('A1:AC1')->getFill()->setFillType('solid')->getStartColor()->setRGB('FFFF00'); // Warna latar belakang kuning
    //     $sheet->getStyle('A1:AB100')->getBorders()->getAllBorders()->setBorderStyle('thin'); // Atur border tipis
    // }

    public function title(): string
    {
        return 'Data Karyawan Keluar';
    }

    public function startCell(): string
    {
        return 'A3';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->mergeCells('A1:AD1');
                $event->sheet->setCellValue('A1', 'Data Karyawan Keluar');
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('A3:AD3')->applyFromArray([
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
                    ]
                ]);

                $dataRange = 'A3:AD' . (3 + self::$rowNumber);
                $event->sheet->getStyle($dataRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000']
                        ],
                    ],
                ]);
                $event->sheet->getStyle('A4:A' . (3 + self::$rowNumber))->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
                $event->sheet->getStyle('H4:H' . (3 + self::$rowNumber))->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
                $event->sheet->getStyle('I4:I' . (3 + self::$rowNumber))->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
                $event->sheet->getStyle('J4:J' . (3 + self::$rowNumber))->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
                $event->sheet->getStyle('K4:K' . (3 + self::$rowNumber))->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
                $event->sheet->getStyle('R4:R' . (3 + self::$rowNumber))->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
                $event->sheet->getStyle('Z4:Z' . (3 + self::$rowNumber))->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
                $event->sheet->getStyle('AD4:AD' . (3 + self::$rowNumber))->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
            }
        ];
    }
}
