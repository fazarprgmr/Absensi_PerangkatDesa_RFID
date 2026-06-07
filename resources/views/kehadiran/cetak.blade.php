<!DOCTYPE html>
<html>

<head>
    <title>Laporan Absensi Harian</title>
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
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            /* text-transform: uppercase; */
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .ttd-container {
            margin-top: 40px;
            float: right;
            width: 200px;
            text-align: center;
        }

        .ttd-space {
            height: 70px;
        }

        .info-tanggal {
            text-align: left;
            margin-top: 10px;
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
        DAFTAR HADIR<br>
        PERANGKAT DESA CIASEM TENGAH KECAMATAN CIASEM KAB. SUBANG<br>

        <div class="info-tanggal">
            <table style="width: auto; border: none;">
                <tr>
                    <td style="border: none; padding: 2px 10px 2px 0;">TANGGAL</td>
                    <td style="border: none; padding: 2px;">:</td>
                    <td style="border: none; padding: 2px;">
                        {{ $hariIni->translatedFormat('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <td style="border: none; padding: 2px 10px 2px 0;">HARI</td>
                    <td style="border: none; padding: 2px;">:</td>
                    <td style="border: none; padding: 2px;">
                        {{ $hariIni->translatedFormat('l') }}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>Status Kehadiran</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kehadirans as $key => $k)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $k->perangkatDesa->nama }}</td>
                    <td class="text-center">{{ $k->perangkatDesa->jabatan->nama_jabatan ?? '-' }}</td>
                    <td class="text-center">{{ $k->perangkatDesa->alamat->dusun ?? '-' }}</td>
                    <td class="text-center">{{ $k->status_kehadiran }}</td>
                    <td class="text-center">{{ $k->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="ttd-container">
        <p>CIASEM TENGAH, {{ $hariIni->translatedFormat('d F Y') }}</p>
        <p><strong>Kepala Desa Ciasem Tengah</strong></p>
        <div class="ttd-space"></div>
        <p><u><strong>{{ $pengaturan->nama_kades }}</strong></u></p>
        @if ($pengaturan->nip_kades != '-' && $pengaturan->nip_kades != null)
            <p style="margin-top: 2px;">NIP. {{ $pengaturan->nip_kades }}</p>
        @endif
    </div>
    
</body>

</html>
