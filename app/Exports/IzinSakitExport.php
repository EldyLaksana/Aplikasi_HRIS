<?php

namespace App\Exports;

use App\Models\IzinSakit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IzinSakitExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $data;

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
            'No ID',
            'Departemen',
            'Nama',
            'Tanggal',
            'Alasan',
            'Keterangan'
        ];
    }

    public function map($izinSakit): array
    {
        return [
            $izinSakit->no_id,
            $izinSakit->departemen,
            $izinSakit->nama,
            $izinSakit->tanggal,
            $izinSakit->alasan,
            $izinSakit->keterangan,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('A1:F1')->getFill()->setFillType('solid')->getStartColor()->setRGB('FFFF00'); // Warna latar belakang kuning
        $sheet->getStyle('A1:F10')->getBorders()->getAllBorders()->setBorderStyle('thin'); // Atur border tipis
    }
}
