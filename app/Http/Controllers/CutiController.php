<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cuti.index', [
            'cutis' => Cuti::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cuti.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'cuti' => ['required'],
            'hari' => 'required',
        ]);

        Cuti::create($validateData);
        return redirect('/cuti')->with('success', 'Cuti berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuti $cuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuti $cuti)
    {
        return view('cuti.edit', [
            'cuti' => $cuti
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cuti $cuti)
    {
        return ($cuti);
        $validateData = $request->validate([
            'cuti' => ['required'],
            'hari' => 'required',
        ]);

        Cuti::where('id', $cuti->id)
            ->update($validateData);
        return redirect('/cuti')->with('success', 'Cuti berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuti $cuti)
    {
        Cuti::destroy($cuti->id);

        return redirect('/cuti')->with('delete', 'Cuti telah dihapus');
    }
}
