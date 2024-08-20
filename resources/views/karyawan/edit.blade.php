@extends('dashboard.layouts.main')

@section('container')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form Edit Karyawan</h1>
    </div>

    <section class="section">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/karyawan" style="text-decoration: none">Karyawan</a></li>
                <li class="breadcrumb-item"><a href="/karyawan/{{ $karyawan->id }}" style="text-decoration: none">Detail
                        karyawan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit karyawan</li>
            </ol>
        </nav>
        <div class="card mb-3">
            <form action="/karyawan/{{ $karyawan->id }}" method="POST" id="" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-header gap-2 d-grid d-lg-flex justify-content-lg-end">
                    <a href="/karyawan/{{ $karyawan->id }}" type="button" class="btn btn-success">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary"
                        onclick="return confirm('Anda yakin mengedit karyawan ini?')">Edit <i
                            class="fa-solid fa-pen"></i></button>
                </div>
                <div class="card-body">
                    <div class="mb-3 col-lg-6">
                        <label for="foto" class="form-label">Pas foto :</label>
                        <input type="hidden" name="fotoLama" id="" value="{{ $karyawan->foto }}">
                        <div class="mb-3">
                            @if ($karyawan->foto)
                                <img src="{{ asset('storage/' . $karyawan->foto) }}" alt="" width="200"
                                    height="200" class="foto_preview d-block border rounded-3">
                            @else
                                <img src="/img/blank-profile2.png" alt="" width="200" height="200"
                                    class="foto_preview d-block border rounded-3">
                            @endif
                        </div>
                        <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto"
                            name="foto" onchange="previewFoto()">
                        @error('foto')
                            <div class="invalid-feedback">
                                File tidak boleh lebih dari 2 mb
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="no_id" class="form-label">No. ID :</label>
                        <input type="text" class="form-control @error('no_id') is-invalid @enderror"
                            placeholder="12 digit" name="no_id" id="no_id"
                            value="{{ old('no_id', $karyawan->no_id) }}" readonly>
                        @error('no_id')
                            <div class="invalid-feedback">
                                No. ID harus diisi (12 digit)
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="departemen_id" class="form-label">Departemen :</label>
                        <select name="departemen_id" id="departemen_id" class="form-select">
                            @foreach ($departemen as $departemen)
                                @if (old('departemen', $karyawan->departemen_id) == $departemen->id)
                                    <option value="{{ $departemen->id }}" selected>{{ $departemen->departemen }}</option>
                                @else
                                    <option value="{{ $departemen->id }}">{{ $departemen->departemen }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="jabatan" class="form-label">Jabatan :</label>
                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan"
                            id="jabatan" value="{{ old('jabatan', $karyawan->jabatan) }}">
                        @error('jabatan')
                            <div class="invalid-feedback">
                                Jabatan harus diisi
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="status_pegawai" class="form-label">Status pegawai :</label>
                        <select class="form-select" name="status_pegawai" id="status_pegawai">
                            {{-- @if (old('status_pegawai') == 'PKWT')
                                <option value="PKWT">PKWT</option>
                            @elseif(old('status_pegawai') == 'PKWTT')
                                <option value="PKWTT">PKWTT</option>
                            @else
                                <option value="PKWT">PKWT</option>
                                <option value="PKWTT">PKWTT</option>
                            @endif --}}
                            <option value="PKWT" {{ $karyawan->status_pegawai == 'PKWT' ? 'selected' : '' }}>PKWT
                            </option>
                            <option value="PKWTT" {{ $karyawan->status_pegawai == 'PKWTT' ? 'selected' : '' }}>PKWTT
                            </option>
                        </select>
                        @error('status_pegawai')
                            <div class="invalid-feedback">
                                Status pegawai harus diisi
                            </div>
                        @enderror
                    </div>
                    <div class="row ">
                        <div class="mb-3 col-lg-4">
                            <label for="tanggal_masuk" class="form-label">Tanggal Masuk :</label>
                            <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                name="tanggal_masuk" id="tanggal_masuk" placeholder="dd/mm/yyyy"
                                value="{{ old('tanggal_masuk', $karyawan->tanggal_masuk) }}">
                            @error('tanggal_masuk')
                                <div class="invalid-feedback">
                                    Tanggal masuk harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="kontrak" class="form-label">Kontrak Karyawan :</label>
                            <input type="date" class="form-control @error('kontrak') is-invalid @enderror"
                                name="kontrak" id="kontrak" placeholder="dd/mm/yyyy"
                                value="{{ old('kontrak', $karyawan->kontrak) }}">
                            @error('kontrak')
                                <div class="invalid-feedback">
                                    Tanggal kontrak harus diisi
                                </div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="my-3" style="font-size: 20px">
                        <h4>Identitas Karyawan</h4>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="nama" class="form-label">Nama :</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            id="nama" value="{{ old('nama', $karyawan->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                Nama harus diisi
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="ktp" class="form-label">No. KTP :</label>
                            <input type="text" class="form-control @error('ktp') is-invalid @enderror"
                                placeholder="16 digit" name="ktp" id="ktp"
                                value="{{ old('ktp', $karyawan->ktp) }}">
                            @error('ktp')
                                <div class="invalid-feedback">
                                    No. KTP harus diisi (16 digit)
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="kk" class="form-label">No. KK :</label>
                            <input type="text" class="form-control @error('kk') is-invalid @enderror"
                                placeholder="16 digit" name="kk" id="kk"
                                value="{{ old('kk', $karyawan->kk) }}">
                            @error('kk')
                                <div class="invalid-feedback">
                                    No. KK harus diisi (16 digit)
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="file_ktp" class="fomr-label">File KTP :</label>
                            <input type="hidden" name="ktpLama" id="" value="{{ $karyawan->file_ktp }}">
                            <div class="mb-3">
                                @if ($karyawan->file_ktp)
                                    <img src="{{ asset('storage/' . $karyawan->file_ktp) }}" alt=""
                                        width="300" height="150" class="ktp_preview d-block rounded-3">
                                @endif
                            </div>
                            <input class="form-control @error('file_ktp') is-invalid @enderror" type="file"
                                id="file_ktp" name="file_ktp" onchange="previewKTP()">
                            @error('file_ktp')
                                <div class="invalid-feedback">
                                    File tidak boleh lebih dari 2 mb
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="file_kk" class="fomr-label">File KK :</label>
                            <input type="hidden" name="kkLama" id="" value="{{ $karyawan->file_kk }}">
                            <div class="mb-3">
                                @if ($karyawan->file_kk)
                                    <img src="{{ asset('storage/' . $karyawan->file_kk) }}" alt=""
                                        width="300" height="150" class="kk_preview d-block rounded-3">
                                @endif
                            </div>
                            <input class="form-control @error('file_kk') is-invalid @enderror" type="file"
                                id="file_kk" name="file_kk" onchange="previewKK()">
                            @error('file_kk')
                                <div class="invalid-feedback">
                                    File tidak boleh lebih dari 2 mb
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="bpjs_kesehatan" class="form-label">No. BPJS kesehatan :</label>
                            <input type="text" class="form-control @error('bpjs_kesehatan') is-invalid @enderror"
                                placeholder="13 digit" name="bpjs_kesehatan" id="bpjs_kesehatan"
                                value="{{ old('bpjs_kesehatan', $karyawan->bpjs_kesehatan) }}">
                            @error('bpjs_kesehatan')
                                <div class="invalid-feedback">
                                    No. BPJS kesehatan harus diisi (13 digit)
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="bpjs_ketenagakerjaan" class="form-label">No. BPJS ketenagakerjaan :</label>
                            <input type="text"
                                class="form-control @error('bpjs_ketenagakerjaan') is-invalid @enderror"
                                placeholder="11 digit" name="bpjs_ketenagakerjaan" id="bpjs_ketenagakerjaan"
                                value="{{ old('bpjs_ketenagakerjaan', $karyawan->bpjs_ketenagakerjaan) }}">
                            @error('bpjs_ketenagakerjaan')
                                <div class="invalid-feedback">
                                    No. BPJS ketenagakerjaan harus diisi (11 digit)
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="jenis_kelamin" class="form-label">Jenis kelamin :</label>
                        <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="Laki-laki" {{ $karyawan->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ $karyawan->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">
                                Jenis kelamin harus diisi
                            </div>
                        @enderror
                    </div>
                    <div class="row ">
                        <div class="mb-3 col-lg-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir :</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                name="tempat_lahir" id="tempat_lahir" placeholder=""
                                value="{{ old('tempat_lahir', $karyawan->tempat_lahir) }}">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    Tempat lahir harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir :</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                name="tanggal_lahir" id="tanggal_lahir" placeholder="dd/mm/yyyy"
                                value="{{ old('tanggal_lahir', $karyawan->tanggal_lahir) }}">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    Tanggal lahir harus diisi
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="agama" class="form-label">Agama :</label>
                        <select class="form-select" name="agama" id="agama">
                            <option value="Islam" {{ $karyawan->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ $karyawan->agama == 'Kristen' ? 'selected' : '' }}>Kristen
                            </option>
                            <option value="Katolik" {{ $karyawan->agama == 'Katolik' ? 'selected' : '' }}>Katolik
                            </option>
                            <option value="Hindu" {{ $karyawan->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ $karyawan->agama == 'Buddha' ? 'selected' : '' }}>Buddha
                            </option>
                            <option value="Khonghucu" {{ $karyawan->agama == 'Khonghucu' ? 'selected' : '' }}>
                                Khonghucu</option>
                        </select>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="pendidikan" class="form-label">Pendidikan :</label>
                        <select class="form-select" name="pendidikan" id="pendidikan">
                            <option value="SD" {{ $karyawan->pendidikan == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ $karyawan->pendidikan == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA/SMK" {{ $karyawan->pendidikan == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK
                            </option>
                            <option value="D1" {{ $karyawan->pendidikan == 'D1' ? 'selected' : '' }}>D1</option>
                            <option value="D2" {{ $karyawan->pendidikan == 'D2' ? 'selected' : '' }}>D2</option>
                            <option value="D3" {{ $karyawan->pendidikan == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ $karyawan->pendidikan == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ $karyawan->pendidikan == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ $karyawan->pendidikan == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-4">
                            <label for="telepon" class="form-label">No. Telepon :</label>
                            <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                name="telepon" id="telepon" placeholder=""
                                value="{{ old('telepon', $karyawan->telepon) }}">
                            @error('telepon')
                                <div class="invalid-feedback">
                                    No. telepon harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="name@example.com" value="{{ old('email', $karyawan->email) }}">
                        </div>
                    </div>
                    <div class="mb-3 col-lg-8">
                        <label for="alamat" class="form-label">Alamat :</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                            id="alamat" placeholder="" value="{{ old('alamat', $karyawan->alamat) }}">
                        @error('alamat')
                            <div class="invalid-feedback">
                                Alamat harus diisi
                            </div>
                        @enderror
                    </div>
                    <hr>
                    <div class="my-3" style="font-size: 20px">
                        <h4>Sosial Media</h4>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-5">
                            <label for="facebook" class="form-label">Facebook :</label>
                            <input type="facebook" class="form-control" name="facebook" id="facebook" placeholder=""
                                value="{{ old('facebook', $karyawan->facebook) }}">
                        </div>
                        <div class="mb-3 col-lg-5">
                            <label for="instagram" class="form-label">Instagram :</label>
                            <input type="instagram" class="form-control" name="instagram" id="instagram" placeholder=""
                                value="{{ old('instagram', $karyawan->instagram) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-5">
                            <label for="tiktok" class="form-label">TikTok :</label>
                            <input type="tiktok" class="form-control" name="tiktok" id="tiktok" placeholder=""
                                value="{{ old('tiktok', $karyawan->tiktok) }}">
                        </div>
                        <div class="mb-3 col-lg-5">
                            <label for="x" class="form-label">X/Twitter :</label>
                            <input type="x" class="form-control" name="x" id="x" placeholder=""
                                value="{{ old('x', $karyawan->x) }}">
                        </div>
                    </div>
                    <hr>
                    <div class="my-3" style="font-size: 20px">
                        <h4>Kontak Darurat</h4>
                    </div>
                    <div class="row">
                        <label for="emergency">Kontak Emergency 1</label>
                        <div class="mb-3 col-lg-4">
                            <label for="nama1" class="form-label">Nama :</label>
                            <input type="text" class="form-control @error('nama1') is-invalid @enderror"
                                name="nama1" id="nama1" placeholder=""
                                value="{{ old('nama1', $karyawan->nama1) }}">
                            @error('nama1')
                                <div class="invalid-feedback">
                                    Nama harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="status1" class="form-label">Status :</label>
                            <input type="text" class="form-control @error('status1') is-invalid @enderror"
                                name="status1" id="status1" placeholder=""
                                value="{{ old('status1', $karyawan->status1) }}">
                            @error('status1')
                                <div class="invalid-feedback">
                                    Status harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="telepon1" class="form-label">Telepon :</label>
                            <input type="text" class="form-control @error('telepon1') is-invalid @enderror"
                                name="telepon1" id="telepon1" placeholder=""
                                value="{{ old('telepon1', $karyawan->telepon1) }}">
                            @error('telepon1')
                                <div class="invalid-feedback">
                                    No. telepon harus diisi
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="emergency">Kontak Emergency 2</label>
                        <div class="mb-3 col-lg-4">
                            <label for="nama2" class="form-label">Nama :</label>
                            <input type="text" class="form-control" name="nama2" id="nama2" placeholder=""
                                value="{{ old('nama2', $karyawan->nama2) }}">
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="status2" class="form-label">Status :</label>
                            <input type="text" class="form-control" name="status2" id="status2" placeholder=""
                                value="{{ old('status2', $karyawan->status2) }}">
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="telepon2" class="form-label">Telepon :</label>
                            <input type="text" class="form-control" name="telepon2" id="telepon2" placeholder=""
                                value="{{ old('telepon2', $karyawan->telepon2) }}">
                        </div>
                    </div>
            </form>
        </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

    {{-- Script untuk tanggal --}}
    <script>
        var dateTimeInput = document.getElementById("tanggal_lahir");

        // var currentDateTime = new Date().toISOString().slice(0, 10);

        // dateTimeInput.value = currentDateTime;
        // const yesterday = new Date();
        // yesterday.setDate(yesterday.getDate() - 1);
        flatpickr("#tanggal_lahir", {

        });
        flatpickr("#tanggal_masuk", {

        });
        flatpickr("#kontrak", {

        });
    </script>
    {{-- End --}}

    {{-- Script untuk preview foto --}}
    <script>
        function previewFoto() {
            const foto = document.querySelector('#foto');
            const fotoPreview = document.querySelector('.foto_preview');

            fotoPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(foto.files[0]);

            oFReader.onload = function(oFREvent) {
                fotoPreview.src = oFREvent.target.result;
            }
        }
    </script>

    <script>
        function previewKTP() {
            const file_ktp = document.querySelector('#file_ktp');
            const ktpPreview = document.querySelector('.ktp_preview');

            ktpPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(file_ktp.files[0]);

            oFReader.onload = function(oFREvent) {
                ktpPreview.src = oFREvent.target.result;
            }
        }
    </script>

    <script>
        function previewKK() {
            const file_kk = document.querySelector('#file_kk');
            const kkPreview = document.querySelector('.kk_preview');

            kkPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(file_kk.files[0]);

            oFReader.onload = function(oFREvent) {
                kkPreview.src = oFREvent.target.result;
            }
        }
    </script>
    {{-- End --}}

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
