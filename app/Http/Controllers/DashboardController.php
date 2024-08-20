<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Departemen;
use App\Models\Karyawan;
use App\Models\KaryawanKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $departemens = Departemen::withCount('karyawan')->get();

        $bulanBatas = 1;
        $karyawanAkanHabis = Karyawan::where('kontrak', '>=', now())->get()
            ->filter(function ($karyawan) use ($bulanBatas) {
                return $karyawan->getSisaKontrakAttribute($bulanBatas);
            });

        // return ($karyawanAkanHabis);
        // $jumlahKaryawan = Karyawan::jumlahKaryawan();
        return view('dashboard.index', [
            'jumlahKaryawan' => Karyawan::jumlahKaryawan(),
            'jumlahKaryawanKeluar' => KaryawanKeluar::jumlahKaryawanKeluar(),
            'departemens' => $departemens,
            'karyawanAkanHabis' => $karyawanAkanHabis
        ]);
    }
}
