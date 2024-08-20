<?php

namespace App\Http\Controllers;

use App\Exports\KaryawanKeluar as ExportsKaryawanKeluar;
use App\Models\Absensi;
use App\Models\CutiKaryawan;
use App\Models\Departemen;
use App\Models\Izin;
use App\Models\IzinSakit;
use App\Models\Karyawan;
use App\Models\KaryawanKeluar;
use App\Models\Sakit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('karyawanKeluar.index');
        $karyawanKeluars = KaryawanKeluar::latest();

        // dd(request('departemen'));
        // dd(request('cari'));
        if (request('cari')) {
            $karyawanKeluars->where('karyawan_keluars.nama', 'like', '%' . request('cari') . '%');
        }

        if (request('departemen')) {
            $karyawanKeluars->where('karyawan_keluars.departemen_id', 'like', request('departemen'));
        }

        return view('karyawanKeluar.index', [
            'karyawanKeluars' => $karyawanKeluars->paginate(20),
            'departemen' => Departemen::all()
        ]);
    }

    // public function prosesKeluar(Request $request, $id)
    // {
    //     $karyawan = Karyawan::find($id);
    //     return view('karyawanKeluar.create');
    // }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $karyawan = Karyawan::find($id);
        // return view('karyawanKeluar.create', [
        //     'karyawan' => $karyawan,
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        // return ($request->all());
        $karyawan = Karyawan::find($id);
        $no_id = $karyawan->no_id;
        $cutiKaryawans = CutiKaryawan::where('no_id', $no_id)->get();
        $absensis = Absensi::where('no_id', $no_id)->get();
        $izin = Izin::where('karyawan_id', $id)->get();
        $sakit = Sakit::where('karyawan_id', $id)->get();
        // $izinSakits = IzinSakit::where('no_id', $no_id)->get();
        // return ($cutiKaryawans);
        $karyawanKeluar = ([
            'foto' => $karyawan->foto,
            'no_id' => $karyawan->no_id,
            'departemen_id' => $karyawan->departemen_id,
            'jabatan' => $karyawan->jabatan,
            'status_pegawai' => $karyawan->status_pegawai,
            'tanggal_masuk' => $karyawan->tanggal_masuk,
            'kontrak' => $karyawan->kontrak,
            'nama' => $karyawan->nama,
            'ktp' => $karyawan->ktp,
            'kk' => $karyawan->kk,
            'file_ktp' => $karyawan->file_ktp,
            'file_kk' => $karyawan->file_kk,
            'bpjs_kesehatan' => $karyawan->bpjs_kesehatan,
            'bpjs_ketenagakerjaan' => $karyawan->bpjs_ketenagakerjaan,
            'jenis_kelamin' => $karyawan->jenis_kelamin,
            'tempat_lahir' => $karyawan->tempat_lahir,
            'tanggal_lahir' => $karyawan->tanggal_lahir,
            'agama' => $karyawan->agama,
            'pendidikan' => $karyawan->pendidikan,
            'telepon' => $karyawan->telepon,
            'email' => $karyawan->email,
            'alamat' => $karyawan->alamat,
            'facebook' => $karyawan->facebook,
            'instagram' => $karyawan->instagram,
            'tiktok' => $karyawan->tiktok,
            'X' => $karyawan->x,
            'nama1' => $karyawan->nama1,
            'status1' => $karyawan->status1,
            'telepon1' => $karyawan->telepon1,
            'nama2' => $karyawan->nama2,
            'status2' => $karyawan->status2,
            'telepon2' => $karyawan->telepon2
        ]);

        // return ($karyawanKeluar);
        KaryawanKeluar::create($karyawanKeluar);
        $cutiKaryawans->map->delete();
        $absensis->map->delete();
        $izin->map->delete();
        $sakit->map->delete();
        // $izinSakits->map->delete();

        $karyawan->delete();
        return redirect('/karyawan')->with('success', 'Karyawan berhasil dikeluarkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(KaryawanKeluar $karyawanKeluar, $id)
    {
        $karyawanKeluar = KaryawanKeluar::find($id);
        // return ($karyawanKeluar);
        return view('karyawanKeluar.show', [
            'karyawanKeluar' => $karyawanKeluar
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KaryawanKeluar $karyawanKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KaryawanKeluar $karyawanKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KaryawanKeluar $karyawanKeluar, $id)
    {
        $karyawanKeluar = KaryawanKeluar::find($id);

        // return ($karyawanKeluar);
        if ($karyawanKeluar->foto) {
            Storage::delete($karyawanKeluar->foto);
        }

        KaryawanKeluar::destroy($karyawanKeluar->id);
        return redirect('/karyawankeluar')->with('success', 'Karyawan berhasil dihapus');
    }

    // public function export()
    // {
    //     return Excel::download(new ExportsKaryawanKeluar, 'karyawan_keluar.xlsx');
    // }

    public function cetak_pdf($id)
    {
        $karyawanKeluar = KaryawanKeluar::find($id);
        // return ($karyawanKeluar);
        $path = storage_path('app/public/' . $karyawanKeluar->foto);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pdf = Pdf::loadView('karyawankeluar.print_pdf', compact('karyawanKeluar', 'base64'));
        return $pdf->download($karyawanKeluar->nama . '.pdf');
    }
}
