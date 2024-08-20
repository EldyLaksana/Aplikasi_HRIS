<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sakit;
use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\IzinSakit;
use App\Models\CutiKaryawan;
use Illuminate\Http\Request;
use App\Exports\AbsensiExport;
use App\Exports\KaryawanExport;
use App\Exports\IzinSakitExport;
use App\Exports\CutiKaryawanExport;
use App\Exports\IzinExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KaryawanKeluarExport;
use App\Exports\SakitExport;
use App\Models\Izin;

class ExportController extends Controller
{
    public function export_karyawan()
    {
        // $karyawan = Karyawan::all();
        // return ($karyawan);
        $tanggalDownload = Carbon::now()->format('Y-m-d');
        $fileNama = $tanggalDownload . '_karyawan.xlsx';
        return Excel::download(new KaryawanExport, $fileNama);
    }

    public function export_karyawankeluar()
    {
        $tanggalDownload = Carbon::now()->format('Y-m-d');
        $fileNama = $tanggalDownload . '_karyawankeluar.xlsx';
        return Excel::download(new KaryawanKeluarExport, $fileNama);
    }

    public function export_cutikaryawan($id)
    {
        $karyawan = Karyawan::find($id);
        $id = $karyawan->id;
        $nama = $karyawan->nama;
        $data = CutiKaryawan::where('karyawan_id', $id)->get();

        $fileNama = 'Cuti_' . $nama . '_export.xlsx';
        // return ($data);
        return Excel::download(new CutiKaryawanExport($data), $fileNama);
    }

    public function export_absensi($id)
    {
        $karyawan = Karyawan::find($id);
        $id = $karyawan->id;
        $nama = $karyawan->nama;
        $data = Absensi::where('karyawan_id', $id)->get();

        $fileNama = 'Abesensi_' . $nama . '_export.xlsx';
        // return ($data);
        return Excel::download(new AbsensiExport($data), $fileNama);
    }

    // public function export_izinsakit($id)
    // {
    //     $karyawan = Karyawan::find($id);
    //     $nama = $karyawan->nama;
    //     $data = IzinSakit::where('nama', $nama)->get();

    //     $fileNama = 'IzinSakit_' . $nama . '_export.xlsx';
    //     return Excel::download(new IzinSakitExport($data), $fileNama);
    // }

    public function export_sakit($id)
    {
        $karyawan = Karyawan::find($id);
        $id = $karyawan->id;
        $nama = $karyawan->nama;
        $data = Sakit::where('karyawan_id', $id)->get();

        // return ($data);

        $fileNama = 'Sakit_' . $nama . '_export.xlsx';
        return Excel::download(new SakitExport($data), $fileNama);
    }

    public function export_izin($id)
    {
        $karyawan = Karyawan::find($id);
        $id = $karyawan->id;
        $nama = $karyawan->nama;
        $data = Izin::where('karyawan_id', $id)->get();

        // return ($data);

        $fileNama = 'Izin_' . $nama . '_export.xlsx';
        return Excel::download(new IzinExport($data), $fileNama);
    }
}
