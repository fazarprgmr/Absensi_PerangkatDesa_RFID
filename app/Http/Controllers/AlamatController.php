<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alamats = Alamat::orderBy('dusun', 'asc')->get();
        
        return view('alamat.index', compact('alamats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alamat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dusun' => 'required|unique:alamats,dusun',
        ]);

        Alamat::create([
            'dusun' => $request->dusun,
        ]);

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil ditambahkan.');
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
        
        $alamat = Alamat::findOrFail($id);

        return view('alamat.edit', compact('alamat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'dusun' => 'required|unique:alamats,dusun,' . $id,
        ]);

        $alamat = Alamat::findOrFail($id);

        $alamat->update([
            'dusun' => $request->dusun,
        ]);

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Alamat::findOrFail($id)->delete();

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil dihapus.');
    }
}
