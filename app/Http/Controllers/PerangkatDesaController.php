<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Jabatan;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;

class PerangkatDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perangkatDesa = PerangkatDesa::all();

        return view('perangkat-desa.index', compact('perangkatDesa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatans = Jabatan::all();
        $alamats = Alamat::all();

        return view('perangkat-desa.create', compact('jabatans', 'alamats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:perangkat_desas,nik',
            'nama' => 'required',
            'alamat_id' => 'required|exists:alamats,id',
            'jabatan_id' => 'required|exists:jabatans,id',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'foto' => 'nullable',
            'rfid_uid' => 'required|unique:perangkat_desas,rfid_uid',

        ], [], [
            'rfid_uid' => 'RFID UID', ]);

        PerangkatDesa::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat_id' => $request->alamat_id,
            'jabatan_id' => $request->jabatan_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'foto' => $request->foto,
            'rfid_uid' => $request->rfid_uid,
        ]);

        return redirect()->route('perangkat-desa.index')->with('success', 'Perangkat Desa berhasil ditambahkan.');
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
        $jabatans = Jabatan::all();
        $alamats = Alamat::all();
        $perangkatDesa = PerangkatDesa::findOrFail($id);

        return view('perangkat-desa.edit', compact('jabatans', 'alamats', 'perangkatDesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nik' => 'required|unique:perangkat_desas,nik,'.$id,
            'nama' => 'required',
            'alamat_id' => 'required|exists:alamats,id',
            'jabatan_id' => 'required|exists:jabatans,id',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'foto' => 'nullable',
            'rfid_uid' => 'required|unique:perangkat_desas,rfid_uid,'.$id,
        ]);

        $perangkatDesa = PerangkatDesa::findOrFail($id);

        $perangkatDesa->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat_id' => $request->alamat_id,
            'jabatan_id' => $request->jabatan_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'foto' => $request->foto,
            'rfid_uid' => $request->rfid_uid,
        ]);

        return redirect()->route('perangkat-desa.index')->with('success', 'Perangkat Desa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PerangkatDesa::findOrFail($id)->delete();

        return redirect()->route('perangkat-desa.index')->with('success', 'Perangkat Desa berhasil dihapus.');
    }
}
