<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $karyawans = Karyawan::find($id);
        $karyawan_id = $karyawans->id;
        $absensis = Absensi::where('karyawan_id', $karyawan_id)->latest()->paginate(10);

        // return ($absensis);
        return view('absensi.index', [
            'karyawan' => $karyawans,
            'absensis' => $absensis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $karyawans = Karyawan::find($id);
        $id = $karyawans->id;
        $absensis = Absensi::where('karyawan_id', $id)->get();

        // return ($absensis);
        return view('absensi.create', [
            'karyawan' => $karyawans,
            'absensis' => $absensis
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
            'tanggal' => 'required',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required'
        ]);
        Absensi::create($validateData);
        return back()->with('success', 'Keterlambatan berhasil ditambhakan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi, $id)
    {
        $absensi = Absensi::find($id);
        $karyawan_id = $absensi->karyawan_id;
        $karyawan = Karyawan::where('id', $karyawan_id)->first();

        return view('absensi.edit', [
            'absensi' => $absensi,
            'karyawan' => $karyawan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absensi $absensi, $id)
    {
        $absensi = Absensi::find($id);
        // return ($request);
        $validateData = $request->validate([
            'no_id' => '',
            'departemen' => '',
            'nama' => '',
            'karyawan_id' => '',
            'tanggal' => 'required',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required'
        ]);

        Absensi::where('id', $absensi->id)->update($validateData);
        return back()->with('success', 'Keterlambatan karyawan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi, $id)
    {
        $absensi = Absensi::find($id);

        // return ($absensi);
        Absensi::destroy($absensi->id);
        return back()->with('success', 'Absensi berhasil direset');
    }
}
