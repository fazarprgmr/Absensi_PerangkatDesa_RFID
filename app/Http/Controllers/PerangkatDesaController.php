<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Jabatan;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage untuk hapus foto lama

class PerangkatDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // OPTIMASI: Gunakan 'with' agar query database jauh lebih cepat (Eager Loading)
        $perangkatDesa = PerangkatDesa::with(['jabatan', 'alamat'])->get();

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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
            'rfid_uid' => 'required|unique:perangkat_desas,rfid_uid',
        ], [], [
            'rfid_uid' => 'RFID UID',
        ]);

        // Logika Upload Foto
        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'perangkat_'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('perangkat_desa', $filename, 'public');
            $namaFoto = $filename;
        }

        PerangkatDesa::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat_id' => $request->alamat_id,
            'jabatan_id' => $request->jabatan_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'foto' => $namaFoto, // Simpan nama file hasil upload
            'rfid_uid' => $request->rfid_uid,
        ]);

        return redirect()->route('perangkat-desa.index')->with('success', 'Perangkat Desa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // OPTIMASI: Hapus Jabatan::all() dan Alamat::all() karena tidak terpakai di halaman detail.
        // Cukup panggil data perangkat desa beserta relasinya.
        $perangkatDesa = PerangkatDesa::with(['jabatan', 'alamat'])->findOrFail($id);

        return view('perangkat-desa.show', compact('perangkatDesa'));
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
            'rfid_uid' => 'required|unique:perangkat_desas,rfid_uid,'.$id,
        ]);

        $perangkatDesa = PerangkatDesa::findOrFail($id);
        $namaFoto = $perangkatDesa->foto; // Default gunakan foto lama

        // Logika Update Foto Baru
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'perangkat_'.$perangkatDesa->id.'_'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('perangkat_desa_profil', $filename, 'public');

            // Hapus foto lama di storage jika ada
            if ($perangkatDesa->foto && Storage::disk('public')->exists('perangkat_desa_profil/'.$perangkatDesa->foto)) {
                Storage::disk('public')->delete('perangkat_desa_profil/'.$perangkatDesa->foto);
            }

            $namaFoto = $filename;
        }

        $perangkatDesa->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat_id' => $request->alamat_id,
            'jabatan_id' => $request->jabatan_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'foto' => $namaFoto,
            'rfid_uid' => $request->rfid_uid,
        ]);

        return redirect()->route('perangkat-desa.index')->with('success', 'Perangkat Desa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perangkatDesa = PerangkatDesa::findOrFail($id);

        // BONUS OPTIMASI: Hapus file foto dari memori storage saat data dihapus
        if ($perangkatDesa->foto && Storage::disk('public')->exists('perangkat_desa/'.$perangkatDesa->foto)) {
            Storage::disk('public')->delete('perangkat_desa/'.$perangkatDesa->foto);
        }

        $perangkatDesa->delete();

        return redirect()->route('perangkat-desa.index')->with('success', 'Perangkat Desa berhasil dihapus.');
    }
}
