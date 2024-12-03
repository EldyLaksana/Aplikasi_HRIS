<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Sakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $karyawans = Karyawan::find($id);
        $id = $karyawans->id;
        $sakits = Sakit::where('karyawan_id', $id)->latest()->paginate(10);

        return view('sakit.index', [
            'karyawan' => $karyawans,
            'sakits' => $sakits
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $karyawans = Karyawan::find($id);
        $id = $karyawans->id;
        $sakits = Sakit::where('karyawan_id', $id)->get();

        return view('sakit.create', [
            'karyawan' => $karyawans,
            'sakits' => $sakits
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
            'keterangan' => 'required',
            'file' => 'file|max:2048'
        ]);
        // return $validateData;

        if ($request->file('file')) {
            $validateData['file'] = $request->file('file')->store('file_sakit');
        }

        Sakit::create($validateData);
        return back()->with('success', 'Sakit karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sakit $sakit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sakit $sakit, $id)
    {
        $sakit = Sakit::find($id);
        $karyawan_id = $sakit->karyawan_id;
        $karyawan = Karyawan::where('id', $karyawan_id)->first();
        // return ($sakit);
        return view('sakit.edit', [
            'sakit' => $sakit,
            'karyawan' => $karyawan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sakit $sakit, $id)
    {
        $sakit = Sakit::find($id);
        // return ($sakit);
        $validateData = $request->validate([
            'no_id' => '',
            'departemen' => '',
            'nama' => '',
            'karyawan_id' => '',
            'tanggal' => 'required',
            'keterangan' => 'required',
            'file' => 'file|max:2048'
        ]);

        // return ($validateData);

        if ($request->file('file')) {
            if ($request->fileLama) {
                Storage::delete($request->fileLama);
            }

            $validateData['file'] = $request->file('file')->store('file_sakit');
        }

        Sakit::where('id', $sakit->id)->update($validateData);
        return back()->with('success', 'Sakit karyawan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sakit $sakit, $id)
    {
        $sakit = Sakit::find($id);
        $id = $sakit->id;

        // return ($sakit);
        Sakit::destroy($id);

        return back()->with('success', 'Sakit karyawan telah dihapus');
    }
}
