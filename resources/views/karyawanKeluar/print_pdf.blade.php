<!DOCTYPE html>
<html>

<head>
    <title>Detail Karyawan Keluar</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin-top: 20px;
        }

        .photo {
            text-align: center;
            margin-bottom: 20px;
        }

        .details table,
        .identity table,
        .social table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .details td,
        .identity td,
        .social td {
            padding: 8px;
            border: 1px solid black;
        }

        .details td strong,
        .identity td strong,
        .social td strong {
            display: inline;
            width: 200px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Detail Karyawan</h1>
            <h2>{{ $karyawanKeluar->nama }}</h2>
        </div>
        <div class="photo">
            <img src="{{ $base64 }}" alt="Foto Karyawan" width="200" height="200">
        </div>
        <div class="content">
            <div class="details">
                <h3>Detail Karyawan Keluar</h3>
                <table>
                    <tr>
                        <td style="width: 200px;"><strong>No. ID:</strong></td>
                        <td>{{ $karyawanKeluar->no_id }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Departemen:</strong></td>
                        <td>{{ $karyawanKeluar->departemen->departemen }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Jabatan:</strong></td>
                        <td>{{ $karyawanKeluar->jabatan }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Status Pegawai:</strong></td>
                        <td>{{ $karyawanKeluar->status_pegawai }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Tanggal Masuk:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($karyawanKeluar->tanggal_masuk)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Tanggal Keluar:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($karyawanKeluar->kontrak)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Lama Kerja:</strong></td>
                        <td>{{ $karyawanKeluar->lama_kerja }}</td>
                    </tr>
                </table>
            </div>

            <div class="identity">
                <h3>Identitas Karyawan</h3>
                <table>
                    <tr>
                        <td style="width: 200px;"><strong>Nama:</strong></td>
                        <td>{{ $karyawanKeluar->nama }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>No. KTP:</strong></td>
                        <td>{{ $karyawanKeluar->ktp }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>No. KK:</strong></td>
                        <td>{{ $karyawanKeluar->kk }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>BPJS Kesehatan:</strong></td>
                        <td>{{ $karyawanKeluar->bpjs_kesehatan }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>BPJS Ketenagakerjaan:</strong></td>
                        <td>{{ $karyawanKeluar->bpjs_ketenagakerjaan }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Jenis Kelamin:</strong></td>
                        <td>{{ $karyawanKeluar->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Tempat Lahir:</strong></td>
                        <td>{{ $karyawanKeluar->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Tanggal Lahir:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($karyawanKeluar->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Agama:</strong></td>
                        <td>{{ $karyawanKeluar->agama }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Pendidikan:</strong></td>
                        <td>{{ $karyawanKeluar->pendidikan }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Telepon:</strong></td>
                        <td>{{ $karyawanKeluar->telepon }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Email:</strong></td>
                        <td>{{ $karyawanKeluar->email }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Alamat:</strong></td>
                        <td>{{ $karyawanKeluar->alamat }}</td>
                    </tr>
                </table>
            </div>

            <div class="social">
                <h3>Sosial Media</h3>
                <table>
                    <tr>
                        <td style="width: 200px;"><strong>Facebook:</strong></td>
                        <td>{{ $karyawanKeluar->facebook }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Instagram:</strong></td>
                        <td>{{ $karyawanKeluar->instagram }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>TikTok:</strong></td>
                        <td>{{ $karyawanKeluar->tiktok }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>X/Twitter:</strong></td>
                        <td>{{ $karyawanKeluar->x }}</td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</body>

</html>
