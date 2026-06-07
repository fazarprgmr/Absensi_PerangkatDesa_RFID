<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        // Mengambil data pengaturan yang pertama (dan satu-satunya)
        $pengaturan = Pengaturan::first();
        return view('pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'jam_masuk' => 'required',
            'jam_toleransi' => 'required',
            'jam_pulang' => 'required',
            'nama_kades' => 'required|string|max:255',
            'nip_kades' => 'nullable|string|max:255',
        ]);

        $pengaturan = Pengaturan::first();
        $pengaturan->update($request->all());

        return redirect()->route('pengaturan.index')->with('success', 'Pengaturan sistem berhasil diperbarui!')->with('active_tab', $request->active_tab);
    }
}