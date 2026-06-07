<!DOCTYPE html>
<html>

<head>
    <title>Laporan Riwayat Kehadiran Perangkat Desa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
        }

        .kop-surat h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .kop-surat p {
            margin: 2px 0;
            font-size: 11px;
        }

        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .biodata {
            margin-bottom: 20px;
            width: 100%;
        }

        .biodata td {
            padding: 4px;
            font-size: 13px;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.data-table th,
        table.data-table td {
            border: 1px solid #000;
            padding: 7px;
            text-align: center;
        }

        table.data-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-left {
            text-align: left;
        }

        .ttd-container {
            margin-top: 40px;
            float: right;
            width: 220px;
            text-align: center;
        }

        .ttd-space {
            height: 60px;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <h2>PEMERINTAH KABUPATEN SUBANG</h2>
        <h2>KECAMATAN CIASEM</h2>
        <h2>DESA CIASEM TENGAH</h2>
        <p>Alamat: Jln Tanjung Baru No, 66 Ciasem Tengah - 41256</p>
    </div>

    <div class="title">
        Laporan Riwayat Kehadiran Harian Perangkat Desa<br>
        Periode Bulan: {{ $namaBulan }} {{ $tahun }}
    </div>

    <!-- Informasi Perangkat Desa yang dicetak -->
    <table class="biodata">
        <tr>
            <td width="15%"><strong>Nama</strong></td>
            <td width="2%">:</td>
            <td><strong>{{ $perangkatDesa->nama }}</strong></td>
        </tr>
        <tr>
            <td><strong>NIK</strong></td>
            <td>:</td>
            <td>{{ $perangkatDesa->nik ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Jabatan</strong></td>
            <td>:</td>
            <td>{{ $perangkatDesa->jabatan->nama_jabatan ?? '-' }}</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="35%">Tanggal</th>
                <th width="15%">Jam Masuk</th>
                <th width="15%">Jam Pulang</th>
                <th width="15%">Status</th>
                <th width="15%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kehadirans as $key => $k)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td class="text-left">
                        {{ \Carbon\Carbon::parse($k->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                    </td>
                    <td>{{ $k->jam_masuk ?? '-' }}</td>
                    <td>{{ $k->jam_pulang ?? '-' }}</td>
                    <td style="text-transform: capitalize;">
                        {{ $k->status_kehadiran }}
                        @if ($k->status_ketepatan == 'terlambat')
                            (Terlambat)
                        @endif
                    </td>
                    <td>{{ $k->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding: 20px; color: #666;">
                        Belum ada catatan kehadiran di bulan ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd-container">
        <p>Ciasem Tengah, {{ $namaBulan }} {{ $tahun }}</p>
        <p><strong>Kepala Desa Ciasem Tengah</strong></p>
        <div class="ttd-space"></div>
        <p><u><strong>{{ $pengaturan->nama_kades }}</strong></u></p>
        @if ($pengaturan->nip_kades != '-' && $pengaturan->nip_kades != null)
            <p style="margin-top: 2px;">NIP. {{ $pengaturan->nip_kades }}</p>
        @endif
    </div>
</body>

</html>
