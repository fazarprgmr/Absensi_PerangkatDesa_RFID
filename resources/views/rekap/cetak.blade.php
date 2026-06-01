<!DOCTYPE html>
<html>

<head>
    <title>Laporan Rekap Bulanan</title>
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
            padding: 7px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-left {
            text-align: left;
        }

        .ttd-container {
            margin-top: 40px;
            float: right;
            width: 200px;
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
        Laporan Rekapitulasi Absensi<br>
        Perangkat Desa Ciasem Tengah Kecamatan Ciasem Kab. Subang<br>
        Periode Bulan: {{ $namaBulan }} {{ $tahun }}
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Perangkat</th>
                <th>Total Hari Aktif</th>
                <th style="color: green;">Hadir (Tepat)</th>
                <th style="color: orange;">Terlambat</th>
                <th style="color: blue;">Izin</th>
                <th style="color: cyan;">Sakit</th>
                <th style="color: red;">Alpa</th>
                <th>Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekaps as $key => $rekap)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td style="font-weight: bold;">{{ $rekap->nama }}</td>
                    <td>{{ $rekap->total_hari }} Hari</td>
                    <td>{{ $rekap->hadir }}</td>
                    <td>{{ $rekap->terlambat }}</td>
                    <td>{{ $rekap->izin }}</td>
                    <td>{{ $rekap->sakit }}</td>
                    <td>{{ $rekap->alpa }}</td>
                    <td style="font-weight: bold;">{{ $rekap->persentase }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd-container">
        <p>Ciasem Tengah, {{ $namaBulan }} {{ $tahun }}</p>
        <p><strong>Kepala Desa Ciasem Tengah</strong></p>
        <div class="ttd-space"></div>
        <p><u><strong>Mista Rangun</strong></u></p>
    </div>
</body>

</html>
