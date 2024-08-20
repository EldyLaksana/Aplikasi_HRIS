<?php

namespace App\Http\Controllers;

use App\Models\CutiKaryawan;
use App\Models\Karyawan;
use App\Models\Cuti;
use Illuminate\Http\Request;

class CutiKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $karyawan = Karyawan::find($id);
        $id = $karyawan->id;
        // return ($karyawan);
        $cutiKaryawans = CutiKaryawan::where('karyawan_id', $id)->latest()->paginate(10);
        $cutiTahunan = CutiKaryawan::where('karyawan_id', $id)->where('cuti', 'Tahunan')->sum('jumlah_hari');

        $jatahCuti = 12;
        $jatahCuti -= $cutiTahunan;

        return view('cutiKaryawan.index', [
            'karyawan' => $karyawan,
            'cutiKaryawans' => $cutiKaryawans,
            'jatahCuti' => $jatahCuti
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $karyawan = Karyawan::find($id);
        // $id = $karyawan->id;
        // $cutiKaryawans = CutiKaryawan::where('karyawan_id', $id)->get();
        // $cutiTahunan = CutiKaryawan::where('karyawan_id', $id)->where('cuti', 'Tahunan')->sum('jumlah_hari');
        $id = $karyawan->id;
        $cutiKaryawans = CutiKaryawan::where('karyawan_id', $id)->get();
        $cutiTahunan = CutiKaryawan::where('karyawan_id', $id)->where('cuti', 'Tahunan')->sum('jumlah_hari');

        $jatahCuti = 12;

        $jatahCuti -= $cutiTahunan;

        return view('cutiKaryawan.create', [
            'karyawan' => $karyawan,
            'cutis' => Cuti::all(),
            'jatahCuti' => $jatahCuti
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return ($request->all());
        $validateData = $request->validate([
            'no_id' => '',
            'departemen' => '',
            'nama' => '',
            'karyawan_id' => '',
            'cuti' => 'required',
            'tanggal_cuti' => 'required',
            'jumlah_hari' => 'required|integer'
        ]);
        // return ($validateData);
        CutiKaryawan::create($validateData);
        // return ($validateData);
        return back()->with('success', 'Cuti berhasil ditambahkan');
    }

    // public function showCuti($nama)
    // {
    //     $cutiKaryawan = CutiKaryawan::where('nama', $nama)->get();
    //     return ($cutiKaryawan);
    // }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CutiKaryawan $cutiKaryawan, $id)
    {
        $cutiKaryawan = CutiKaryawan::find($id);
        $karyawan_id = $cutiKaryawan->karyawan_id;

        $karyawan = Karyawan::where('id', $karyawan_id)->first();
        $cutiTahunan = CutiKaryawan::where('karyawan_id', $karyawan_id)->where('cuti', 'Tahunan')->sum('jumlah_hari');

        $jatahCuti = 12;

        $jatahCuti -= $cutiTahunan;
        // return ($karyawan);
        return view('cutiKaryawan.edit', [
            'cutiKaryawan' => $cutiKaryawan,
            'karyawan' => $karyawan,
            'cutis' => Cuti::all(),
            'jatahCuti' => $jatahCuti,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CutiKaryawan $cutiKaryawan, $id)
    {
        $cutiKaryawan = CutiKaryawan::find($id);
        // return ($request);

        $validateData = $request->validate([
            'no_id' => '',
            'departemen' => '',
            'nama' => '',
            // 'karyawan_id' => '',
            'cuti' => 'required',
            'tanggal_cuti' => 'required',
            'jumlah_hari' => 'required|integer'
        ]);

        CutiKaryawan::where('id', $cutiKaryawan->id)->update($validateData);
        return back()->with('success', 'Cuti karyawan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $karyawans = Karyawan::find($id);

        // return ($karyawans);

        $nama = $karyawans->nama;
        $cutiKaryawans = CutiKaryawan::where('nama', $nama)->get();


        CutiKaryawan::destroy($cutiKaryawans);
        return back()->with('success', 'Cuti berhasil direset');
    }
}
