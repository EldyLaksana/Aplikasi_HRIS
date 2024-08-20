<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jabatan.index', [
            'jabatan' => Jabatan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'jabatan' => ['required', 'unique:jabatans'],
        ]);

        Jabatan::create($validateData);
        return redirect('/jabatan')->with('success', 'Jabatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $validateData = $request->validate([
            'jabatan' => ['required', 'unique:jabatans'],
        ]);

        Jabatan::where('id', $jabatan->id)
            ->update($validateData);
        return redirect('/jabatan')->with('success', 'Jabatan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        Jabatan::destroy($jabatan->id);

        return redirect('/jabatan')->with('delete', 'Jabatan telah dihapus');
    }
}
