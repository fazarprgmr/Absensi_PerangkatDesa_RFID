<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\PerangkatDesa;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today()->toDateString();

        // 1. Total Semua Perangkat Desa
        $totalPerangkatDesa = PerangkatDesa::count();

        // 2. Total Yang Benar-Benar "Hadir" (Yang izin/sakit TIDAK DIHITUNG)
        $totalHadirHariIni = Kehadiran::where('tanggal', $hariIni)
            ->where('status_kehadiran', 'hadir')
            ->count();

        // 3. Khusus menghitung yang Sakit/Izin
        $totalSakitIzinHariIni = Kehadiran::where('tanggal', $hariIni)
            ->whereIn('status_kehadiran', ['sakit', 'izin'])
            ->count();

        // 4. Logika Mutlak: Tidak Hadir = Total Orang - Yang Hadir
        $totalTidakHadirHariIni = $totalPerangkatDesa - ($totalHadirHariIni + $totalSakitIzinHariIni);

        // 5. Ambil 5 Log Absensi Terbaru + Foto Bukti dari ESP32-CAM
        $absensiTerbaru = Kehadiran::with(['perangkatDesa.jabatan'])
            ->where('tanggal', $hariIni) // <-- INI TAMBAHANNYA: Filter khusus hari ini
            ->orderBy('jam_masuk', 'desc') // <-- Urutkan dari jam masuk paling terakhir/baru
            ->take(5)
            ->get();

        // 6. Data Grafik Kehadiran 7 Hari Terakhir
        $grafikKehadiran = Kehadiran::selectRaw('tanggal, COUNT(*) as jumlah_hadir')
            ->where('status_kehadiran', 'hadir')
            ->where('tanggal', '>=', Carbon::now()->subDays(6)->toDateString())
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        // Pisahkan data tanggal dan jumlah untuk grafik
        $chartLabels = $grafikKehadiran->pluck('tanggal')->map(fn ($tgl) => Carbon::parse($tgl)->translatedFormat('d M'))->toArray();
        $chartData = $grafikKehadiran->pluck('jumlah_hadir')->toArray();

        // 7. Lempar data yang BERSIH ke view
        return view('dashboard', compact(
            'totalPerangkatDesa',
            'totalHadirHariIni',
            'totalSakitIzinHariIni',
            'totalTidakHadirHariIni', // Cukup pakai ini saja
            'absensiTerbaru',
            'chartLabels',
            'chartData'
        ));
    }
}
