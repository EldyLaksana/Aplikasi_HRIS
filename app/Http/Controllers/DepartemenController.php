<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('departemen.index', [
            'departemens' => Departemen::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departemen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'departemen' => ['required', 'unique:departemens']
        ]);

        Departemen::create($validateData);
        return redirect('/departemen')->with('success', 'Departemen berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departemen $departemen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departemen $departemen, $id)
    {
        $departemen = Departemen::find($id);
        // return ($departemen);
        return view('departemen.edit', [
            'departemen' => $departemen
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departemen $departemen, $id)
    {
        $departemen = Departemen::find($id);

        // return ($departemen);
        $validateData = $request->validate([
            'departemen' => ['required']
        ]);

        // return ($validateData);
        Departemen::where('id', $departemen->id)
            ->update($validateData);
        return redirect('/departemen')->with('success', 'Departemen berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departemen $departemen, $id)
    {
        $departemen = Departemen::find($id);

        // return ($departemen);

        Departemen::destroy($departemen->id);

        return redirect('/departemen')->with('delete', 'Departemen telah dihapus');
    }
}
