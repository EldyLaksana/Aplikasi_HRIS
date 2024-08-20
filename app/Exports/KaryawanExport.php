<?php

namespace App\Exports;

use App\Models\Karyawan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KaryawanExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithCustomStartCell, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private static $rowNumber = 0;

    public function collection()
    {
        return Karyawan::all();
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
            'Kontrak',
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

    public function map($karyawan): array
    {
        return [
            // $karyawan->no_id,
            // $karyawan->departemen->departemen,
            // $karyawan->nama,
            // $karyawan->tempat_lahir,
            // Carbon::parse($karyawan->tanggal_lahir)->translatedFormat('d F Y'),
            // $karyawan->telepon,
            // $karyawan->email,
            // $karyawan->alamat,
            // $karyawan->ktp,
            // $karyawan->pendidikan,
            // $karyawan->agama,
            // $karyawan->nama1,
            // $karyawan->status1,
            // $karyawan->telepon1,
            // $karyawan->nama2,
            // $karyawan->status2,
            // $karyawan->telepon2,
            ++self::$rowNumber,
            $karyawan->no_id,
            $karyawan->departemen->departemen,
            $karyawan->jabatan,
            $karyawan->status_pegawai,
            Carbon::parse($karyawan->tanggal_masuk)->translatedFormat('d F Y'),
            Carbon::parse($karyawan->kontrak)->translatedFormat('d F Y'),
            $karyawan->nama,
            $karyawan->ktp,
            $karyawan->kk,
            $karyawan->bpjs_kesehatan,
            $karyawan->bpjs_ketenagakerjaan,
            $karyawan->jenis_kelamin,
            $karyawan->tempat_lahir,
            Carbon::parse($karyawan->tanggal_lahir)->translatedFormat('d F Y'),
            $karyawan->agama,
            $karyawan->pendidikan,
            $karyawan->alamat,
            $karyawan->telepon,
            $karyawan->email,
            $karyawan->facebook,
            $karyawan->instagram,
            $karyawan->tiktok,
            $karyawan->x,
            $karyawan->nama1,
            $karyawan->status1,
            $karyawan->telepon1,
            $karyawan->nama2,
            $karyawan->status2,
            $karyawan->telepon2,
        ];
    }

    // public function styles(Worksheet $sheet)
    // {

    //     $sheet->getStyle('A1:AC1')->getFont()->setBold(true);
    //     $sheet->getStyle('A1:AC1')->getFill()->setFillType('solid')->getStartColor()->setRGB('FFFF00'); // Warna latar belakang kuning
    // }

    public function title(): string
    {
        return 'Data Karyawan';
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
                $event->sheet->setCellValue('A1', 'Data Karyawan ');
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
                    ],
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
