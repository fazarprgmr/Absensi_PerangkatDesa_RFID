<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kehadiran;
use App\Models\Pengaturan;
use App\Models\PerangkatDesa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KehadiranController extends Controller
{
    public function tapRFID(Request $request)
    {
        $request->validate([
            'rfid_uid' => 'required|string',
        ]);

        $uid = $request->rfid_uid;

        // Simpan UID ke cache selama 1 menit untuk form pendaftaran
        Cache::put('temp_rfid', $uid, now()->addMinutes(1));

        $perangkatDesa = PerangkatDesa::where('rfid_uid', $uid)->first();

        if (! $perangkatDesa) {
            return response()->json(['message' => 'Kartu Tidak Terdaftar!'], 404);
        }

        $standarJamMasuk = Pengaturan::first();

        $hariIni = Carbon::today();
        $sekarang = Carbon::now();
        $jamSekarang = $sekarang->format('H:i:s');
        $batasPulang = $standarJamMasuk->jam_pulang;

        // Cari data absen hari ini
        $absen = Kehadiran::where('perangkat_desa_id', $perangkatDesa->id)
            ->where('tanggal', $hariIni)
            ->first();

        // 1. LOGIKA JIKA SUDAH ADA DATA ABSEN HARI INI
        if ($absen) {
            // A. Cek apakah sudah absen pulang?
            if ($absen->jam_pulang) {
                return response()->json([
                    'message' => 'Sudah Absen Pulang!', 
                    'nama' => $perangkatDesa->nama,
                ], 200);
            }

            // B. Jika belum absen pulang, cek apakah sudah masuk jam pulang?
            if ($jamSekarang < $batasPulang) {
                return response()->json([
                    'message' => 'Sudah Absen Masuk!', 
                    'nama' => $perangkatDesa->nama,
                ], 200);
            }

            // C. Jika sudah waktunya dan belum absen pulang -> Proses Pulang
            $absen->update(['jam_pulang' => $jamSekarang]);

            // 🚀 PERBAIKAN: Simpan info kalau barusan ini adalah alur "PULANG" ke Cache
            Cache::put('last_absen_id', $absen->id, now()->addMinutes(2));
            Cache::put('last_absen_type', 'pulang', now()->addMinutes(2));

            return response()->json([
                'message' => 'Absen Pulang Berhasil!',
                'nama' => $perangkatDesa->nama,
                'jam_pulang' => $jamSekarang,
            ], 200);
        }

        // 2. LOGIKA JIKA BELUM ADA DATA (ABSEN MASUK)
        $batasTelat = $standarJamMasuk->jam_toleransi;
        $statusKetepatan = ($jamSekarang > $batasTelat) ? 'terlambat' : 'tepat waktu';

        $absenBaru = Kehadiran::create([
            'perangkat_desa_id' => $perangkatDesa->id,
            'tanggal' => $hariIni,
            'jam_masuk' => $jamSekarang,
            'status_kehadiran' => 'hadir',
            'status_ketepatan' => $statusKetepatan,
            'keterangan' => null,
        ]);

        // 🚀 PERBAIKAN: Simpan info kalau barusan ini adalah alur "MASUK" ke Cache
        Cache::put('last_absen_id', $absenBaru->id, now()->addMinutes(2));
        Cache::put('last_absen_type', 'masuk', now()->addMinutes(2));

        return response()->json([
            'message' => 'Absen Masuk Berhasil!',
            'nama' => $perangkatDesa->nama,
            'status_kehadiran' => 'hadir',
            'status_ketepatan' => $statusKetepatan,
            'keterangan' => null,
        ], 201);
    }

    // Fungsi simpanFoto yang sudah DIPERBARUI & DILEBIH AMANKAN
    public function simpanFoto(Request $request)
    {
        if ($request->hasFile('image')) {

            // 🚀 AMBIL ID DARI CACHE (Bukan latest updated_at agar tidak ketukar/salah target)
            $lastId = Cache::get('last_absen_id');
            $tipeAbsen = Cache::get('last_absen_type', 'masuk'); // default ke masuk

            $absenTerakhir = Kehadiran::find($lastId);

            // Kalau di cache sudah habis waktunya, baru gunakan fallback ke updated_at
            if (!$absenTerakhir) {
                $absenTerakhir = Kehadiran::latest('updated_at')->first();
            }

            if ($absenTerakhir) {
                $file = $request->file('image');

                // Beri nama foto secara unik berdasarkan TIPENYA
                $filename = $tipeAbsen . '_' . $absenTerakhir->id . '_' . time() . '.jpg';

                // Simpan ke storage/app/public/absensi
                $file->storeAs('absensi', $filename, 'public');

                // 🚀 PISAHKAN KOLOM SIMPAN BERDASARKAN TIPE ABSENSI
                if ($tipeAbsen === 'pulang') {
                    $absenTerakhir->update([
                        'foto_bukti_pulang' => $filename,
                    ]);
                } else {
                    $absenTerakhir->update([
                        'foto_bukti' => $filename,
                    ]);
                }

                return response()->json([
                    'message' => "Foto bukti ($tipeAbsen) berhasil disimpan!",
                    'file' => $filename
                ], 200);
            }
        }

        return response()->json(['message' => 'Gagal, tidak ada foto yang diterima'], 400);
    }
}