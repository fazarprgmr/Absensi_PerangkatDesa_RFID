<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Pengaturan;
use App\Models\PerangkatDesa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter bulan dan tahun dari request (default ke bulan & tahun berjalan saat ini)
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        // Ambil semua perangkat desa beserta riwayat kehadirannya di bulan & tahun yang dipilih
        $perangkatDesas = PerangkatDesa::with(['kehadirans' => function ($query) use ($bulan, $tahun) {
            $query->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun);
        }])->get();

        $rekaps = [];
        foreach ($perangkatDesas as $pd) {
            // Hitung akumulasi status kehadiran dari database harian
            $hadir = $pd->kehadirans->where('status_kehadiran', 'hadir')->count();
            $izin = $pd->kehadirans->where('status_kehadiran', 'izin')->count();
            $sakit = $pd->kehadirans->where('status_kehadiran', 'sakit')->count();
            $alpa = $pd->kehadirans->where('status_kehadiran', 'alpa')->count();

            // Hitung berapa kali dia terlambat masuk kerja
            $terlambat = $pd->kehadirans->where('status_ketepatan', 'terlambat')->count();

            // Hadir Tepat Waktu = Total Hadir dikurangi Terlambat
            $hadir_tepat = $hadir - $terlambat;

            // Total hari aktif/kerja adalah gabungan seluruh hari yang ada record-nya
            $total_hari = $hadir + $izin + $sakit + $alpa;

            // Rumus Persentase Kehadiran: (Hadir / Total Hari Kerja) * 100
            $persentase = $total_hari > 0 ? round(($hadir / $total_hari) * 100) : 0;

            // Bungkus data menjadi objek rapi untuk dilempar ke View
            $rekaps[] = (object) [
                'id' => $pd->id,
                'nama' => $pd->nama,
                'total_hari' => $total_hari,
                'hadir' => $hadir_tepat,
                'izin' => $izin,
                'sakit' => $sakit,
                'alpa' => $alpa,
                'terlambat' => $terlambat,
                'persentase' => $persentase,
            ];
        }

        // Array nama bulan Indonesia untuk mempermudah dropdown select di Blade
        $listBulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
        ];

        return view('rekap.index', compact('rekaps', 'bulan', 'tahun', 'listBulan'));
    }

    public function cetak(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $perangkatDesas = PerangkatDesa::with(['kehadirans' => function ($query) use ($bulan, $tahun) {
            $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();

        $rekaps = [];
        foreach ($perangkatDesas as $pd) {
            $hadir = $pd->kehadirans->where('status_kehadiran', 'hadir')->count();
            $izin = $pd->kehadirans->where('status_kehadiran', 'izin')->count();
            $sakit = $pd->kehadirans->where('status_kehadiran', 'sakit')->count();
            $alpa = $pd->kehadirans->where('status_kehadiran', 'alpa')->count();
            $terlambat = $pd->kehadirans->where('status_ketepatan', 'terlambat')->count();

            $hadir_tepat = $hadir - $terlambat;
            $total_hari = $hadir + $izin + $sakit + $alpa;
            $persentase = $total_hari > 0 ? round(($hadir / $total_hari) * 100) : 0;

            $rekaps[] = (object) [
                'nama' => $pd->nama,
                'total_hari' => $total_hari,
                'hadir' => $hadir_tepat,
                'izin' => $izin,
                'sakit' => $sakit,
                'alpa' => $alpa,
                'terlambat' => $terlambat,
                'persentase' => $persentase,
            ];
        }

        $listBulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
        ];

        $namaBulan = $listBulan[$bulan];

        $pengaturan = Pengaturan::first();

        // Set ukuran kertas Lanscape (Tiduran) agar tabel rekap yang panjang muat dengan sempurna
        $pdf = Pdf::loadView('rekap.cetak', compact('rekaps', 'namaBulan', 'tahun', 'pengaturan'))
            ->setPaper('a4', 'landscape');

        return $pdf->download("Laporan-Rekap-Absensi-{$namaBulan}-{$tahun}.pdf");
    }

    public function show($id, Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        // Cari data perangkat desa berdasarkan ID
        $perangkatDesa = PerangkatDesa::findOrFail($id);

        // Ambil riwayat absen spesifik HANYA untuk orang ini di bulan & tahun yang dipilih
        $kehadirans = Kehadiran::where('perangkat_desa_id', $id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'asc') // Urutkan dari tanggal 1 sampai akhir bulan
            ->get();

        $listBulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
        ];
        $namaBulan = $listBulan[$bulan];

        return view('rekap.show', compact('perangkatDesa', 'kehadirans', 'bulan', 'tahun', 'namaBulan'));
    }

    public function cetakDetail($id, Request $request)
    {
        // Tangkap filter bulan dan tahun dari halaman sebelumnya
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        // Cari data perangkat desa berdasarkan ID
        $perangkatDesa = PerangkatDesa::findOrFail($id);

        // Ambil riwayat absen spesifik HANYA untuk orang ini di bulan & tahun yang dipilih
        $kehadirans = Kehadiran::where('perangkat_desa_id', $id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'asc')
            ->get();

        $listBulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
        ];
        $namaBulan = $listBulan[$bulan];

        $pengaturan = Pengaturan::first();

        // Load view PDF khusus detail per orang (Kertas A4 Portrait)
        $pdf = Pdf::loadView('rekap.cetak-detail', compact('perangkatDesa', 'kehadirans', 'bulan', 'tahun', 'namaBulan', 'pengaturan'))
            ->setPaper('a4', 'portrait');

        // Otomatis download dengan nama file yang rapi
        return $pdf->download("Laporan-Detail-Absensi-{$perangkatDesa->nama}-{$namaBulan}-{$tahun}.pdf");
    }
}
