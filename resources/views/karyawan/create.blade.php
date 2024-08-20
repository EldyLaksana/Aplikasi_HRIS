@extends('dashboard.layouts.main')

@section('container')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form Tambah Karyawan</h1>
    </div>

    <section class="section">
        <div class="card mb-3">
            <form action="{{ url('karyawan') }}" method="POST" id="" enctype="multipart/form-data">
                @csrf
                <div class="card-header d-grid d-lg-flex justify-content-lg-end">
                    <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-file-circle-plus"></i> Tambah
                    </button>
                </div>
                <div class="card-body">
                    <div class="mb-3 col-lg-6">
                        <label for="foto" class="form-label">Pas foto :</label>
                        <img src="/img/blank-profile2.png" class="foto_preview img-fluid mb-3" width="200" height="200"
                            style="display: block">
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
                        <input type="text" class="form-control @error('no_id') is-invalid @enderror" placeholder="No. ID"
                            name="no_id" id="no_id" value="{{ old('no_id') }}">
                        @error('no_id')
                            <div class="invalid-feedback">
                                No. ID harus diisi
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="departemen_id" class="form-label">Departemen :</label>
                        <select name="departemen_id" id="departemen_id" class="form-select">
                            @foreach ($departemen as $departemen)
                                @if (old('departemen') == $departemen->id)
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
                            id="jabatan" value="{{ old('jabatan') }}">
                        @error('jabatan')
                            <div class="invalid-feedback">
                                Jabatan harus diisi
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="status_pegawai" class="form-label">Status pegawai :</label>
                        <select class="form-select" name="status_pegawai" id="status_pegawai">
                            @if (old('status_pegawai') == 'PKWT')
                                <option value="PKWT">PKWT</option>
                            @elseif(old('status_pegawai') == 'PKWTT')
                                <option value="PKWTT">PKWTT</option>
                            @else
                                <option value="PKWT">PKWT</option>
                                <option value="PKWTT">PKWTT</option>
                            @endif
                        </select>
                        @error('status_pegawai')
                            <div class="invalid-feedback">
                                Status pegawai harus diisi
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-4">
                            <label for="tanggal_masuk" class="form-label">Tanggal Masuk :</label>
                            <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                name="tanggal_masuk" id="tanggal_masuk" placeholder="dd/mm/yyyy"
                                value="{{ old('tanggal_masuk') }}">
                            @error('tanggal_masuk')
                                <div class="invalid-feedback">
                                    Tanggal masuk harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="kontrak" class="form-label">Kontrak Karyawan :</label>
                            <input type="date" class="form-control @error('kontrak') is-invalid @enderror" name="kontrak"
                                id="kontrak" placeholder="dd/mm/yyyy" value="{{ old('kontrak') }}">
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
                            id="nama" value="{{ old('nama') }}">
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
                                placeholder="16 digit" name="ktp" id="ktp" value="{{ old('ktp') }}">
                            @error('ktp')
                                <div class="invalid-feedback">
                                    No. KTP harus diisi (16 digit)
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="kk" class="form-label">No. KK :</label>
                            <input type="text" class="form-control @error('kk') is-invalid @enderror"
                                placeholder="16 digit" name="kk" id="kk" value="{{ old('kk') }}">
                            @error('kk')
                                <div class="invalid-feedback">
                                    No. KK harus diisi (16 digit)
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="file_ktp" class="form-label">File KTP :</label>
                            <img class="ktp_preview img-fluid mb-3 col-sm-6">
                            <input class="form-control @error('file_ktp') is-invalid @enderror" type="file"
                                id="file_ktp" name="file_ktp" onchange="previewKTP()">
                            @error('file_ktp')
                                <div class="invalid-feedback">
                                    File tidak boleh lebih dari 2 mb
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="file_kk" class="form-label">File KK :</label>
                            <img class="kk_preview img-fluid mb-3 col-sm-6">
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
                                value="{{ old('bpjs_kesehatan') }}">
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
                                value="{{ old('bpjs_ketenagakerjaan') }}">
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
                            @if (old('jenis_kelamin') == 'Laki-laki')
                                <option value="Laki-laki">Laki-laki</option>
                            @elseif(old('jenis_kelamin') == 'Perempuan')
                                <option value="Perempuan">Perempuan</option>
                            @else
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            @endif
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">
                                Jenis kelamin harus diisi
                            </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="mb-3 col-lg-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir :</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                name="tempat_lahir" id="tempat_lahir" placeholder="" value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    Tempat lahir harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir :</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                name="tanggal_lahir" id="tanggal_lahir" placeholder="dd/mm/yyyy"
                                value="{{ old('tanggal_lahir') }}">
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
                            @if (old('agama') == 'Islam')
                                <option value="Islam" selected>Islam</option>
                            @elseif (old('agama') == 'Kristen')
                                <option value="Kristen" selected>Kristen</option>
                            @elseif (old('agama') == 'Katolik')
                                <option value="Katolik" selected>Katolik</option>
                            @elseif (old('agama') == 'Hindu')
                                <option value="Hindu" selected>Hindu</option>
                            @elseif (old('agama') == 'Buddha')
                                <option value="Buddha" selected>Buddha</option>
                            @elseif(old('agama') == 'Khonghucu')
                                <option value="Khonghucu" selected>Khonghucu</option>
                            @else
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Khonghucu">Khonghucu</option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="pendidikan" class="form-label">Pendidikan :</label>
                        <select class="form-select" name="pendidikan" id="pendidikan">
                            @if (old('pendidikan') == 'SD')
                                <option value="SD" selected>SD</option>
                            @elseif(old('pendidikan') == 'SMP')
                                <option value="SMP" selected>SMP</option>
                            @elseif(old('pendidikan') == 'SMA/SMK')
                                <option value="SMA/SMK" selected>SMA/SMK</option>
                            @elseif(old('pendidikan') == 'D1')
                                <option value="D1" selected>D1</option>
                            @elseif(old('pendidikan') == 'D2')
                                <option value="D2" selected>D2</option>
                            @elseif(old('pendidikan') == 'D3')
                                <option value="D3" selected>D3</option>
                            @elseif(old('pendidikan') == 'S1')
                                <option value="S1" selected>S1</option>
                            @elseif(old('pendidikan') == 'S2')
                                <option value="S2" selected>S2</option>
                            @elseif(old('pendidikan') == 'S3')
                                <option value="S3" selected>S3</option>
                            @else
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA/SMK">SMA/SMK</option>
                                <option value="D1">D1</option>
                                <option value="D2">D2</option>
                                <option value="D3">D3</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            @endif
                        </select>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-4">
                            <label for="telepon" class="form-label">No. Telepon :</label>
                            <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                name="telepon" id="telepon" placeholder="" value="{{ old('telepon') }}">
                            @error('telepon')
                                <div class="invalid-feedback">
                                    No. telepon harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="name@example.com" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="mb-3 col-lg-8">
                        <label for="alamat" class="form-label">Alamat :</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                            id="alamat" placeholder="" value="{{ old('alamat') }}">
                        @error('alamat')
                            <div class="invalid-feedback ">
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
                                value="{{ old('facebook') }}">
                        </div>
                        <div class="mb-3 col-lg-5">
                            <label for="instagram" class="form-label">Instagram :</label>
                            <input type="instagram" class="form-control" name="instagram" id="instagram" placeholder=""
                                value="{{ old('instagram') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-5">
                            <label for="tiktok" class="form-label">TikTok :</label>
                            <input type="tiktok" class="form-control" name="tiktok" id="tiktok" placeholder=""
                                value="{{ old('tiktok') }}">
                        </div>
                        <div class="mb-3 col-lg-5">
                            <label for="x" class="form-label">X/Twitter :</label>
                            <input type="x" class="form-control" name="x" id="x" placeholder=""
                                value="{{ old('x') }}">
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
                                name="nama1" id="nama1" placeholder="" value="{{ old('nama1') }}">
                            @error('nama1')
                                <div class="invalid-feedback">
                                    Nama harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="status1" class="form-label">Status :</label>
                            <input type="text" class="form-control @error('status1') is-invalid @enderror"
                                name="status1" id="status1" placeholder="" value="{{ old('status1') }}">
                            @error('status1')
                                <div class="invalid-feedback">
                                    Status harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="telepon1" class="form-label">Telepon :</label>
                            <input type="text" class="form-control @error('telepon1') is-invalid @enderror"
                                name="telepon1" id="telepon1" placeholder="" value="{{ old('telepon1') }}">
                            @error('telepon1')
                                <div class="invalid-feedback">
                                    No. telepon harus diisi
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <label for="emergency">Kontak Emergency 2</label>
                        <div class="mb-3 col-lg-4">
                            <label for="nama2" class="form-label">Nama :</label>
                            <input type="text" class="form-control" name="nama2" id="nama2" placeholder=""
                                value="{{ old('nama2') }}">
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="status2" class="form-label">Status :</label>
                            <input type="text" class="form-control" name="status2" id="status2" placeholder=""
                                value="{{ old('status2') }}">
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="telepon2" class="form-label">Telepon :</label>
                            <input type="text" class="form-control" name="telepon2" id="telepon2" placeholder=""
                                value="{{ old('telepon2') }}">
                        </div>
                    </div>
                </div>
            </form>
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
@endsection
