<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\PerangkatDesa;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        return view('kehadiran.create', compact('perangkatDesa'));
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
        ]);

        Kehadiran::create([
            'perangkat_desa_id' => $request->perangkat_desa_id,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'status_kehadiran' => $request->status_kehadiran,
            'status_ketepatan' => $request->status_ketepatan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kehadiran.index')->with('success', 'Kehadiran berhasil ditambahkan.');
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
        $perangkatDesa = PerangkatDesa::all();
        $kehadiran = Kehadiran::findOrFail($id);

        return view('kehadiran.edit', compact('perangkatDesa', 'kehadiran'));
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
        ]);

        $kehadiran = Kehadiran::findOrFail($id);

        $kehadiran->update([
            'perangkat_desa_id' => $request->perangkat_desa_id,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'status_kehadiran' => $request->status_kehadiran,
            'status_ketepatan' => $request->status_ketepatan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kehadiran.index')->with('success', 'Kehadiran berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kehadiran::findOrFail($id)->delete();

        return redirect()->route('kehadiran.index')->with('success', 'Kehadiran berhasil dihapus');
    }

    public function cetak()
    {
        $hariIni = Carbon::today();
        $kehadirans = Kehadiran::with('perangkatDesa')
            ->whereDate('tanggal', $hariIni)
            ->orderBy('jam_masuk', 'desc')
            ->get();

        // Load view khusus PDF dan set ukuran kertas ke A4 Potrait
        $pdf = Pdf::loadView('kehadiran.cetak', compact('kehadirans', 'hariIni'))
            ->setPaper('a4', 'portrait');

        // Otomatis download file dengan nama Laporan-Harian-[tanggal].pdf
        return $pdf->download('Laporan-Harian-'.$hariIni->format('Y-m-d').'.pdf');
    }
}
