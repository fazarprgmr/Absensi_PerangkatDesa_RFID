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
        // Menghitung jumlah perangkat_desa di setiap jabatan
        $jabatans = Jabatan::withCount('perangkatDesas')->get();

        return view('jabatan.index', compact('jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|unique:jabatans,nama_jabatan',
        ]);

        Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
        ]);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        return view('jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|unique:jabatans,nama_jabatan,'.$id,
        ]);

        $jabatan = Jabatan::findOrFail($id);

        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan,
        ]);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Jabatan::findOrFail($id)->delete();

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}
