<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $karyawan = Karyawan::find($id);
        $id = $karyawan->id;
        $izins = Izin::where('karyawan_id', $id)->latest()->paginate(10);
        // return ($izins);
        return view('izin.index', [
            'karyawan' => $karyawan,
            'izins' => $izins,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $karyawan = Karyawan::find($id);

        return view('izin.create', [
            'karyawan' => $karyawan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return ($request);
        $validateData = $request->validate([
            'no_id' => '',
            'departemen' => '',
            'nama' => '',
            'karyawan_id' => '',
            'tanggal' => 'required',
            'izin' => 'required',
            'jam' => '',
            'jam_selesai' => '',
            'alasan' => 'required',
        ]);
        // return ($validateData);
        Izin::create($validateData);
        return back()->with('success', 'Izin karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Izin $izin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Izin $izin, $id)
    {
        $izin = Izin::find($id);
        $karyawan_id = $izin->karyawan_id;

        $karyawan = Karyawan::where('id', $karyawan_id)->first();
        // return ($karyawan);
        return view('izin.edit', [
            'izin' => $izin,
            'karyawan' => $karyawan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Izin $izin, $id)
    {
        $izin = Izin::find($id);
        // return ($izin);
        $validateData = $request->validate([
            'no_id' => '',
            'departemen' => '',
            'nama' => '',
            'karyawan_id' => '',
            'tanggal' => 'required',
            'izin' => 'required',
            'jam' => '',
            'jam_selesai' => '',
            'alasan' => 'required',
        ]);

        Izin::where('id', $izin->id)->update($validateData);
        return back()->with('success', 'Izin karyawan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Izin $izin, $id)
    {
        $izin = Izin::find($id);

        Izin::destroy($izin->id);
        return back()->with('success', 'Izin karyawan telah dihapus');
    }
}
