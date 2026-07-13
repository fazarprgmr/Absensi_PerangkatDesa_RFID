<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Pengaturan;
use App\Models\PerangkatDesa;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil tanggal hari ini persis seperti zona waktu Indonesia
        $hariIni = Carbon::today();

        // Ambil data kehadiran HANYA untuk hari ini, dan urutkan dari yang terbaru absen
        $kehadirans = Kehadiran::with('perangkatDesa')
            ->whereDate('tanggal', $hariIni)
            ->orderBy('jam_masuk', 'desc')
            ->get();

        return view('kehadiran.index', compact('kehadirans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perangkatDesa = PerangkatDesa::all();
        $pengaturan = Pengaturan::first();

        return view('kehadiran.create', compact('perangkatDesa', 'pengaturan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'perangkat_desa_id' => 'required|exists:perangkat_desas,id',
            'tanggal' => 'required',
            'jam_masuk' => 'nullable',
            'jam_pulang' => 'nullable',
            'status_kehadiran' => 'required',
            'status_ketepatan' => 'nullable',
            'keterangan' => 'nullable',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto manual
        ]);

        // Siapkan variabel untuk menyimpan nama foto (default null)
        $namaFoto = null;
        
        // Logika Upload Foto saat bikin data baru manual
        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $filename = 'foto_bukti_'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('absensi', $filename, 'public');
            
            $namaFoto = $filename;
        }

        Kehadiran::create([
            'perangkat_desa_id' => $request->perangkat_desa_id,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'status_kehadiran' => $request->status_kehadiran,
            'status_ketepatan' => $request->status_ketepatan,
            'keterangan' => $request->keterangan,
            'foto_bukti' => $namaFoto, // Simpan nama foto jika ada, atau null jika tidak ada
        ]);

        return redirect()->route('kehadiran.index')->with('success', 'Kehadiran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perangkatDesa = PerangkatDesa::all();
        $kehadiran = Kehadiran::findOrFail($id);

        return view('kehadiran.show', compact('perangkatDesa', 'kehadiran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $perangkatDesa = PerangkatDesa::all();
        $kehadiran = Kehadiran::findOrFail($id);
        $pengaturan = Pengaturan::first();

        return view('kehadiran.edit', compact('perangkatDesa', 'kehadiran', 'pengaturan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'perangkat_desa_id' => 'required|exists:perangkat_desas,id',
            'tanggal' => 'required',
            'jam_masuk' => 'nullable',
            'jam_pulang' => 'nullable',
            'status_kehadiran' => 'required',
            'status_ketepatan' => 'nullable',
            'keterangan' => 'nullable',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
        ]);

        $kehadiran = Kehadiran::findOrFail($id);

        // Ambil nama foto lama sebagai default
        $namaFoto = $kehadiran->foto_bukti;

        // Logika Upload Foto saat mengedit data
        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $filename = 'foto_bukti_'.$kehadiran->id.'_'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('absensi', $filename, 'public');

            // Hapus foto lama di storage jika ada agar tidak memenuhi memori
            if ($kehadiran->foto_bukti && Storage::disk('public')->exists('absensi/'.$kehadiran->foto_bukti)) {
                Storage::disk('public')->delete('absensi/'.$kehadiran->foto_bukti);
            }

            $namaFoto = $filename;
        }

        $kehadiran->update([
            'perangkat_desa_id' => $request->perangkat_desa_id,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'status_kehadiran' => $request->status_kehadiran,
            'status_ketepatan' => $request->status_ketepatan,
            'keterangan' => $request->keterangan,
            'foto_bukti' => $namaFoto ?? $kehadiran->foto_bukti, // Tetap gunakan foto lama jika tidak ada upload baru
        ]);

        return redirect()->route('kehadiran.index')->with('success', 'Kehadiran berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kehadiran = Kehadiran::findOrFail($id);

        // BONUS: Hapus file foto dari memori storage saat data absen dihapus!
        if ($kehadiran->foto_bukti && Storage::disk('public')->exists('absensi/'.$kehadiran->foto_bukti)) {
            Storage::disk('public')->delete('absensi/'.$kehadiran->foto_bukti);
        }

        $kehadiran->delete();

        return redirect()->route('kehadiran.index')->with('success', 'Kehadiran berhasil dihapus');
    }

    public function cetak()
    {
        $hariIni = Carbon::today();
        $kehadirans = Kehadiran::with('perangkatDesa')
            ->whereDate('tanggal', $hariIni)
            ->orderBy('jam_masuk', 'desc')
            ->get();

        $pengaturan = Pengaturan::first();

        // Load view khusus PDF dan set ukuran kertas ke A4 Potrait
        $pdf = Pdf::loadView('kehadiran.cetak', compact('kehadirans', 'hariIni', 'pengaturan'))
            ->setPaper('a4', 'portrait');

        // Otomatis download file dengan nama Laporan-Harian-[tanggal].pdf
        return $pdf->download('Laporan Absensi '.$hariIni->translatedFormat('l, d F Y').'.pdf');
    }
}
