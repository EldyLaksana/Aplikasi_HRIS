<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // return (Divisi::all());
        return view('divisi.index', [
            'divisi' => Divisi::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_divisi' => 'required',
            'divisi' => ['required', 'unique:divisis'],
        ]);

        Divisi::create($validateData);
        return redirect('/divisi')->with('success', 'Divisi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Divisi $divisi)
    {
        $validateData = $request->validate([
            'kode_divisi' => 'required',
            'divisi' => ['required', 'unique:divisis'],
        ]);

        Divisi::where('id', $divisi->id)
            ->update($validateData);
        return redirect('/divisi')->with('success', 'Divisi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Divisi $divisi)
    {
        Divisi::destroy($divisi->id);

        return redirect('/divisi')->with('delete', 'Divisi telah dihapus');
    }
}
