<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\Sakit;
use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\Departemen;
use App\Models\CutiKaryawan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Storage;



class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::orderBy('departemen_id', 'asc');

        // dd(request('departemen'));
        // dd(request('cari'));
        if (request('cari')) {
            $karyawans->where('karyawans.nama', 'like', '%' . request('cari') . '%');
        }

        if (request('departemen')) {
            $karyawans->where('karyawans.departemen_id', 'like', request('departemen'));
        }

        $karyawans = $karyawans->paginate(20)->appends(request()->except('page'));

        return view('karyawan.index', [
            'karyawans' => $karyawans,
            'departemen' => Departemen::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.create', [
            'departemen' => Departemen::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return ($request->all());
        $validateData = $request->validate([
            'foto' => ['image', 'file', 'max:2048'],
            'no_id' => ['required', 'max:12', 'min:12', 'unique:karyawans'],
            'departemen_id' => 'required',
            'jabatan' => 'required',
            'status_pegawai' => 'required',
            'nama' => 'required',
            'ktp' => ['max:16', 'min:16', 'unique:karyawans'],
            'kk' => ['max:16', 'min:16'],
            'file_ktp' => ['image', 'file', 'max:2048'],
            'file_kk' => ['image', 'file', 'max:2048'],
            'bpjs_kesehatan' => ['max:13', 'min:13'],
            'bpjs_ketenagakerjaan' => ['max:11', 'min:11'],
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'pendidikan' => 'required',
            'telepon' => '',
            'email' => '',
            'alamat' => '',
            'facebook' => '',
            'instagram' => '',
            'tiktok' => '',
            'x' => '',
            'tanggal_masuk' => 'required',
            'kontrak' => '',
            'nama1' => '',
            'status1' => '',
            'telepon1' => '',
            'nama2' => '',
            'status2' => '',
            'telepon2' => ''
        ]);

        // return ($validateData);

        if ($request->file('foto')) {
            $validateData['foto'] = $request->file('foto')->store('foto');
        }

        if ($request->file('file_ktp')) {
            $validateData['file_ktp'] = $request->file('file_ktp')->store('file_ktp');
        }

        if ($request->file('file_kk')) {
            $validateData['file_kk'] = $request->file('file_kk')->store('file_kk');
        }
        // return ($validateData);
        Karyawan::create($validateData);
        return redirect('/karyawan')->with('success', 'Karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        // return ($karyawan);

        return view('karyawan.show', [
            'karyawan' => $karyawan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', [
            'karyawan' => $karyawan,
            'departemen' => Departemen::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        // return ($request->all());
        $rules = [
            'foto' => ['image', 'file', 'max:2048'],
            'departemen_id' => 'required',
            'status_pegawai' => 'required',
            'nama' => 'required',
            'kk' => ['max:16', 'min:16'],
            'file_ktp' => ['image', 'file', 'max:2048'],
            'file_kk' => ['image', 'file', 'max:2048'],
            'bpjs_kesehatan' => ['max:13', 'min:13'],
            'bpjs_ketenagakerjaan' => ['max:11', 'min:11'],
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'pendidikan' => 'required',
            'telepon' => '',
            'email' => '',
            'alamat' => '',
            'facebook' => '',
            'instagram' => '',
            'tiktok' => '',
            'x' => '',
            'tanggal_masuk' => 'required',
            'kontrak' => '',
            'nama1' => '',
            'status1' => '',
            'telepon1' => '',
            'nama2' => '',
            'status2' => '',
            'telepon2' => ''
        ];

        if ($request->no_id != $karyawan->no_id) {
            $rules['no_id'] = ['required', 'max:12', 'min:12', 'unique:karyawans'];
        }

        if ($request->ktp != $karyawan->ktp) {
            $rules['ktp'] = ['required', 'max:16', 'min:16', 'unique:karyawans'];
        }

        $validateData = $request->validate($rules);

        if ($request->file('foto')) {
            if ($request->fotoLama) {
                Storage::delete($request->fotoLama);
            }

            $validateData['foto'] = $request->file('foto')->store('foto');
        }

        if ($request->file('file_ktp')) {
            if ($request->ktpLama) {
                Storage::delete($request->ktpLama);
            }

            $validateData['file_ktp'] = $request->file('file_ktp')->store('file_ktp');
        }

        if ($request->file('file_kk')) {
            if ($request->kkLama) {
                Storage::delete($request->kkLama);
            }

            $validateData['file_kk'] = $request->file('file_kk')->store('file_kk');
        }

        // return ($validateData);

        Karyawan::where('id', $karyawan->id)
            ->update($validateData);
        return redirect('/karyawan')->with('success', 'Data karyawan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        //
    }

    public function info(Karyawan $karyawan, $id)
    {
        // $id = $karyawan->id;
        $karyawan = Karyawan::find($id);
        $id = $karyawan->id;
        $cutiKaryawans = CutiKaryawan::where('karyawan_id', $id)->paginate(10);
        $cutiTahunan = CutiKaryawan::where('karyawan_id', $id)->where('cuti', 'Tahunan')->sum('jumlah_hari');
        $absensis = Absensi::where('karyawan_id', $id)->paginate(10);
        $sakits = Sakit::where('karyawan_id', $id)->paginate(10);
        $izins = Izin::where('karyawan_id', $id)->paginate(10);

        // return ($karyawans);

        $jatahCuti = 12;

        $jatahCuti -= $cutiTahunan;
        // foreach ($cutiKaryawans as $cuti) {
        //     $jatahCuti -= $cuti->jumlah_hari;
        // }

        return view('karyawan.info', [
            'karyawan' => $karyawan,
            'cutiKaryawans' => $cutiKaryawans,
            'absensis' => $absensis,
            'jatahCuti' => $jatahCuti,
            'sakits' => $sakits,
            'izins' => $izins,
        ]);
    }

    public function kontrak($id)
    {
        $karyawan = Karyawan::find($id);
        // return ($karyawan);

        return view('karyawan.kontrak', [
            'karyawan' => $karyawan
        ]);
    }

    public function perbarui(Request $request, $id)
    {
        // return ($request);
        $karyawan = Karyawan::find($id);
        $id = $karyawan->id;

        $cutiKaryawan = CutiKaryawan::where('karyawan_id', $id)->get();
        $izin = Izin::where('karyawan_id', $id)->get();
        $sakit = Sakit::where('karyawan_id', $id)->get();
        $absensi = Absensi::where('karyawan_id', $id)->get();

        // return ($cutiKaryawan);
        $validateData = $request->validate([
            'kontrak' => 'required',
        ]);

        // return ($validateData);
        Karyawan::where('id', $id)->update($validateData);
        $cutiKaryawan->map->delete();
        // $izin->map->delete();
        // $sakit->map->delete();
        // $absensi->map->delete();
        return redirect('/karyawan')->with('success', 'Kontrak karyawan telah diperbarui');
    }

    // public function cetak_pdf(Karyawan $karyawan, $id)
    // {
    //     $karyawan = Karyawan::find($id);
    //     $data = [
    //         'nama' => $karyawan->nama,
    //     ];

    //     return ($data['nama']);
    //     return view('karyawan.karyawan_pdf', [
    //         'karyawan' => $karyawan,
    //         'data' => $data
    //     ]);

    //     $pdf = Pdf::loadView('karyawan.karyawan_pdf', ['karyawan' => $karyawan]);
    //     $pdf->setPaper('landscape');
    //     return $pdf->download($data['nama'] . '.pdf');
    // }

    public function cetak_pdf($id)
    {
        $karyawan = Karyawan::find($id);
        // return ($karyawan);
        if ($karyawan->foto) {
            $path = storage_path('app/public/' . $karyawan->foto);
        } else {
            $path = public_path('/img/blank-profile2.png');
        }
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pdf = Pdf::loadView('karyawan.print_pdf', compact('karyawan', 'base64'));
        return $pdf->download($karyawan->nama . '.pdf');
    }
}
