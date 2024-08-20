<!DOCTYPE html>
<html>

<head>
    <title>Detail Karyawan</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header,
        .footer {
            text-align: center;
        }

        .content {
            margin-top: 20px;
        }

        .photo {
            text-align: center;
            margin-bottom: 20px;
        }

        .details {
            margin-bottom: 20px;
        }

        .details table {
            width: 100%;
            /* Membuat tabel memenuhi lebar kontainer */
            border-collapse: collapse;
            /* Menghilangkan jarak antar sel tabel */
        }

        .details td {
            padding: 8px;
            /* Memberikan padding pada sel tabel */
            border: 1px solid #ddd;
            /* Menambahkan border pada sel tabel */
        }

        .details td strong {
            display: inline;
            width: 50px;
            /* Lebar tetap yang lebih kecil untuk kolom pertama */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Detail Karyawan</h1>
            <h2>{{ $karyawan->nama }}</h2>
        </div>
        <div class="photo">
            <img src="{{ $base64 }}" alt="Foto Karyawan" width="200" height="200">
        </div>
        <div class="content">
            <div class="details">
                <table>
                    <tr>
                        <td style="width: 200px;"><strong>No. ID:</strong></td>
                        <td>{{ $karyawan->no_id }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Departemen:</strong></td>
                        <td>{{ $karyawan->departemen->departemen }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Jabatan:</strong></td>
                        <td>{{ $karyawan->jabatan }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Status Pegawai:</strong></td>
                        <td>{{ $karyawan->status_pegawai }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Tanggal Masuk:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Kontrak:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($karyawan->kontrak)->translatedFormat('d F Y') }}</td>
                    </tr>
                </table>


                <h3>Identitas Karyawan</h3>
                <table>
                    <tr>
                        <td style="width: 200px;"><strong>Nama:</strong></td>
                        <td>{{ $karyawan->nama }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>No. KTP:</strong></td>
                        <td>{{ $karyawan->ktp }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>No. KK:</strong></td>
                        <td>{{ $karyawan->kk }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>BPJS Kesehatan:</strong></td>
                        <td>{{ $karyawan->bpjs_kesehatan }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>BPJS Ketenagakerjaan:</strong></td>
                        <td>{{ $karyawan->bpjs_ketenagakerjaan }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Jenis Kelamin</strong></td>
                        <td>{{ $karyawan->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Tempat Lahir:</strong></td>
                        <td>{{ $karyawan->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Tanggal Lahir:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($karyawan->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Agama:</strong></td>
                        <td>{{ $karyawan->agama }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Pendidikan:</strong></td>
                        <td>{{ $karyawan->pendidikan }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Telepon:</strong></td>
                        <td>{{ $karyawan->telepon }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Email:</strong></td>
                        <td>{{ $karyawan->email }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Alamat:</strong></td>
                        <td>{{ $karyawan->alamat }}</td>
                    </tr>
                </table>


                <h3>Sosial Media</h3>
                <table>
                    <tr>
                        <td style="width: 200px;"><strong>Facebook:</strong></td>
                        <td>{{ $karyawan->facebook }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Instagram:</strong></td>
                        <td>{{ $karyawan->instagram }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>TikTok:</strong></td>
                        <td>{{ $karyawan->tiktok }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>X/Twitter:</strong></td>
                        <td>{{ $karyawan->x }}</td>
                    </tr>
                </table>

                <h3>Kontak Darurat 1</h3>
                <table>
                    <tr>
                        <td style="width: 200px;"><strong>Nama:</strong></td>
                        <td>{{ $karyawan->nama1 }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Status:</strong></td>
                        <td>{{ $karyawan->status1 }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Telepon:</strong></td>
                        <td>{{ $karyawan->telepon1 }}</td>
                    </tr>
                </table>

                <h3>Kontak Darurat 2</h3>
                <table>
                    <tr>
                        <td style="width: 200px;"><strong>Nama:</strong></td>
                        <td>{{ $karyawan->nama2 }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Status:</strong></td>
                        <td>{{ $karyawan->status2 }}</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Telepon:</strong></td>
                        <td>{{ $karyawan->telepon2 }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <div class="footer">
        <p>&copy; {{ date('Y') }} PT. Ratu Makmur Abadi</p>
    </div>
    </div>
</body>

</html>
