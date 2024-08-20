<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- Custom styles for this template -->
{{-- Bootstrap Icon --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

{{-- Font Awsome Icon --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css">
<script src="https://kit.fontawesome.com/65bd75b526.js" crossorigin="anonymous"></script> --}}

{{-- Feather Icons --}}
<script src="https://unpkg.com/feather-icons"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script> --}}

{{-- Flatpickr --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Custom styles for this template -->
<link href="/css/dashboard.css" rel="stylesheet">

<div class="">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom ms-lg-auto">
        <h1 class="h2">Detail Karyawan "{{ $karyawan->nama }}"</h1>
    </div>

    <div class="card ms-lg-auto">
        <div class="card-body">
            <div class="mb-3">
                @if ($karyawan->foto)
                    <img src="{{ $base64 }}" alt="" width="200" height="200">
                @else
                    <img src="/img/blank-profile2.png" alt="" width="200" height="200">
                @endif
            </div>
            <div class="mb-3 col-lg-4">
                <label for="no_id" class="form-label">No. ID :</label>
                <input type="text" class="form-control" name="no_id" id="no_id" value="{{ $karyawan->no_id }}"
                    readonly>
            </div>
            <div class="mb-3 col-lg-6">
                <label for="departemen" class="form-label">Departemen :</label>
                <input type="text" class="form-control" name="departemen" id="departemen"
                    value="{{ $karyawan->departemen->departemen }}" readonly>
            </div>
            <div class="mb-3 col-lg-6">
                <label for="jabatan" class="form-label">Jabatan :</label>
                <input type="text" class="form-control" name="jabatan" id="jabatan"
                    value="{{ $karyawan->jabatan }}" readonly>
            </div>
            <div class="mb-3 col-lg-6">
                <label for="status_pegawai" class="form-label">Status Pegawai :</label>
                <input type="text" class="form-control" name="status_pegawai" id="status_pegawai"
                    value="{{ $karyawan->status_pegawai }}" readonly>
            </div>
            <div class="mb-3 col-lg-6">
                <label for="nama" class="form-label">Nama :</label>
                <input type="text" class="form-control" name="nama" id="nama" value="{{ $karyawan->nama }}"
                    readonly>
            </div>
            <div class="mb-3 col-lg-6">
                <label for="ktp" class="form-label">KTP :</label>
                <input type="text" class="form-control" name="ktp" id="ktp" value="{{ $karyawan->ktp }}"
                    readonly>
            </div>
            <div class="mb-3 col-lg-6">
                <label for="jenis_kelamin" class="form-label">Jenis kelamin :</label>
                <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin"
                    value="{{ $karyawan->jenis_kelamin }}" readonly>
            </div>
            <div class="row mb-3">
                <div class="mb-3 col-lg-6">
                    <label for="tempat_lahir" class="form-label">Tempat lahir :</label>
                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                        value="{{ $karyawan->tempat_lahir }}" readonly>
                </div>
                <div class="mb-3 col-lg-4">
                    <label for="tanggal_lahir" class="form-label">Tempat lahir :</label>
                    <input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                        value="{{ \Carbon\Carbon::parse($karyawan->tanggal_lahir)->translatedFormat('d F Y') }}"
                        readonly>
                </div>
            </div>
            <div class="mb-3 col-lg-4">
                <label for="agama" class="form-label">Agama :</label>
                <input type="text" class="form-control" name="agama" id="agama"
                    value="{{ $karyawan->agama }}" readonly>
            </div>
            <div class="mb-3 col-lg-4">
                <label for="pendidikan" class="form-label">Pendidikan :</label>
                <input type="text" class="form-control" name="pendidikan" id="pendidikan"
                    value="{{ $karyawan->pendidikan }}" readonly>
            </div>
            <div class="row mb-3">
                <div class="mb-3 col-lg-4">
                    <label for="telepon" class="form-label">Telepon :</label>
                    {{-- <a href="https://wa.me/{{ '62' . substr($karyawan->telepon, 1) }}" class="badge bg-success"
                        target="_blank"><i class="fa-solid fa-phone"></i></a> --}}
                    <input type="text" class="form-control" name="telepon" id="telepon"
                        value="{{ $karyawan->telepon }}" readonly>
                </div>
                <div class="mb-3 col-lg-4">
                    <label for="email" class="form-label">Email :</label>
                    <input type="text" class="form-control" name="email" id="email"
                        value="{{ $karyawan->email }}" readonly>
                </div>
            </div>
            <div class="mb-3 col-lg-8">
                <label for="alamat" class="form-label">Alamat :</label>
                <input type="text" class="form-control" name="alamat" id="alamat"
                    value="{{ $karyawan->alamat }}" readonly>
            </div>
            <div class="row mb-3">
                <div class="mb-3 col-lg-4">
                    <label for="tanggal_masuk" class="form-label">Tanggal masuk :</label>
                    <input type="text" class="form-control" name="tanggal_masuk" id="tanggal_masuk"
                        value="{{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->translatedFormat('d F Y') }}"
                        readonly>
                </div>
                <div class="mb-3 col-lg-4">
                    <label for="kontrak" class="form-label">Kontrak :</label>
                    <input type="text" class="form-control" name="kontrak" id="kontrak"
                        value="{{ \Carbon\Carbon::parse($karyawan->kontrak)->translatedFormat('d F Y') }}" readonly>
                    {{-- @if ($kontrakHabis)
                                <p>Kontrak akan habis</p>
                            @endif --}}
                </div>
                <div class="mb-3 col-lg-4">
                    <label for="lama_kerja" class="form-label">Lama kerja :</label>
                    {{-- <p>{{ $lamaKerja->y }} Tahun, {{ $lamaKerja->m }} Bulan, {{ $lamaKerja->d }} Hari</p> --}}
                    <input type="text" class="form-control" name="lama_kerja" id="lama_kerja"
                        value="{{ $karyawan->lama_kerja }}" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="emergency">Kontak Emergency 1</label>
                <div class="mb-3 col-lg-4">
                    <label for="nama1" class="form-label">Nama :</label>
                    <input type="text" class="form-control" name="nama1" id="nama1"
                        value="{{ $karyawan->nama1 }}" readonly>
                </div>
                <div class="mb-3 col-lg-4">
                    <label for="status1" class="form-label">Status :</label>
                    <input type="text" class="form-control" name="status1" id="status1"
                        value="{{ $karyawan->status1 }}" readonly>
                </div>
                <div class="mb-3 col-lg-4">
                    <label for="telepon1" class="form-label">Telepon :</label>
                    <input type="text" class="form-control" name="telepon1" id="telepon1"
                        value="{{ $karyawan->telepon1 }}" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="emergency">Kontak Emergency 2</label>
                <div class="mb-3 col-lg-4">
                    <label for="nama2" class="form-label">Nama :</label>
                    <input type="text" class="form-control" name="nama2" id="nama2"
                        value="{{ $karyawan->nama2 }}" readonly>
                </div>
                <div class="mb-3 col-lg-4">
                    <label for="status2" class="form-label">Status :</label>
                    <input type="text" class="form-control" name="status2" id="status2"
                        value="{{ $karyawan->status2 }}" readonly>
                </div>
                <div class="mb-3 col-lg-4">
                    <label for="telepon2" class="form-label">Telepon :</label>
                    <input type="text" class="form-control" name="telepon2" id="telepon2"
                        value="{{ $karyawan->telepon2 }}" readonly>
                </div>
            </div>
            {{-- <div class="d-grid gap-2 d-lg-flex justify-content-lg-end">
                <button id="printButton" class="btn btn-info" style="color: white"> <i
                        class="fa-solid fa-print"></i>
                    Cetak</button>
            </div> --}}
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#printButton').on('click', function() {
            window.print();
        });
    });
</script>

{{-- JS Booststrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

{{-- JS Feather Icon --}}
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>

<script src="/js/dashboard.js"></script>
