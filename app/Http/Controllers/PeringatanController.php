<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Peringatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeringatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $karyawans = Karyawan::findOrFail($id);
        $karyawan_id = $karyawans->id;
        $peringatans = Peringatan::where('karyawan_id', $karyawan_id)->latest()->paginate(10);

        // return ($absensis);
        return view('peringatan.index', [
            'karyawan' => $karyawans,
            'peringatans' => $peringatans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $karyawans = Karyawan::findOrFail($id);
        $id = $karyawans->id;
        // $sakits = Sakit::where('karyawan_id', $id)->get();

        return view('peringatan.create', [
            'karyawan' => $karyawans,
            // 'sakits' => $sakits
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validateData = $request->validate([
            'no_id' => '',
            'departemen' => '',
            'nama' => '',
            'karyawan_id' => '',
            'tanggal' => 'required',
            'keterangan' => 'required',
            'file' => 'file|max:2048'
        ]);

        if ($request->file('file')) {
            $validateData['file'] = $request->file('file')->store('file_peringatan');
        }

        Peringatan::create($validateData);
        // return back()->with('success', 'Peringatan karyawan berhasil ditambahkan');
        return redirect()->route('peringatan.index', ['id' => $request->karyawan_id])
            ->with('success', 'Peringatan karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peringatan $peringatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peringatan $peringatan, $id)
    {

        $peringatan = Peringatan::findOrFail($id);
        $karyawan_id = $peringatan->karyawan_id;
        $karyawan = Karyawan::where('id', $karyawan_id)->first();
        // return $peringatan;
        return view('peringatan.edit', [
            'peringatan' => $peringatan,
            'karyawan' => $karyawan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peringatan $peringatan, $id)
    {
        $peringatan = Peringatan::findOrFail($id);

        $validateData = $request->validate([
            'no_id' => '',
            'departemen' => '',
            'nama' => '',
            'karyawan_id' => '',
            'tanggal' => 'required',
            'keterangan' => 'required',
            'file' => 'file|max:2048'
        ]);

        if ($request->file('file')) {
            if ($request->fileLama) {
                Storage::delete($request->fileLama);
            }

            $validateData['file'] = $request->file('file')->store('file_peringatan');
        }

        Peringatan::where('id', $peringatan->id)->update($validateData);
        return redirect()->route('peringatan.index')->with('success', 'Peringatan karyawan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peringatan $peringatan, $id)
    {
        $peringatan = Peringatan::findOrFail($id);
        $id = $peringatan->id;

        Peringatan::destroy($id);

        return redirect()->route('peringatan.index')->with('success', 'Peringatan karyawan berhasil dihapus');
    }
}
