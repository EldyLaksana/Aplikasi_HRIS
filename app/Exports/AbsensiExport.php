<?php

namespace App\Exports;

use App\Models\Absensi;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
            'Jam Masuk',
            'Jam Pulang',
        ];
    }

    public function map($absensi): array
    {
        return [
            ++self::$rowNumber,
            $absensi->no_id,
            $absensi->departemen,
            $absensi->nama,
            Carbon::parse($absensi->tanggal)->format('d/m/Y'),
            $absensi->jam_masuk,
            $absensi->jam_pulang,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getFill()->setFillType('solid')->getStartColor()->setRGB('FFFF00'); // Warna latar belakang kuning

    }
}
