@extends('dashboard.layouts.main')

@section('container')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Karyawan Keluar</h1>
    </div>
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/karyawankeluar">Karyawan keluar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail karyawan</li>
            </ol>
        </nav>
        <div class="card mb-3">
            <form action="/karyawankeluar/{{ $karyawanKeluar->id }}" method="POST">
                @method('delete')
                @csrf
                <div class="card-header d-grid gap-2 d-lg-flex justify-content-lg-end">
                    <a href="/karyawankeluar" type="button" class="btn btn-success">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Anda yakin menghapus karyawan ini?')"><i class="fa-solid fa-trash"></i>
                        Hapus</button>
                </div>
            </form>

            <div class="card-body">
                <div class="mb-3">
                    @if ($karyawanKeluar->foto)
                        <img src="{{ asset('storage/' . $karyawanKeluar->foto) }}" alt="" width="200"
                            height="200" class="border rounded-3">
                    @else
                        <img src="/img/blank-profile2.png" alt="" width="200" height="200"
                            class="border rounded-3">
                    @endif
                </div>
                <div class="mb-3 col-lg-4">
                    <label for="no_id" class="form-label">No. ID :</label>
                    <input type="text" class="form-control" name="no_id" id="no_id"
                        value="{{ $karyawanKeluar->no_id }}" readonly>
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="departemen" class="form-label">Departemen :</label>
                    <input type="text" class="form-control" name="departemen" id="departemen"
                        value="{{ $karyawanKeluar->departemen->departemen }}" readonly>
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="jabatan" class="form-label">Departemen :</label>
                    <input type="text" class="form-control" name="jabatan" id="jabatan"
                        value="{{ $karyawanKeluar->jabatan }}" readonly>
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="status_pegawai" class="form-label">Status pegawai :</label>
                    <input type="text" class="form-control" name="status_pegawai" id="status_pegawai"
                        value="{{ $karyawanKeluar->status_pegawai }}" readonly>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-4">
                        <label for="tanggal_masuk" class="form-label">Tanggal masuk :</label>
                        <input type="text" class="form-control" name="tanggal_masuk" id="tanggal_masuk"
                            value="{{ \Carbon\Carbon::parse($karyawanKeluar->tanggal_masuk)->translatedFormat('d F Y') }}"
                            readonly>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="tanggal_keluar" class="form-label">Tanggal keluar :</label>
                        <input type="text" class="form-control" name="tanggal_keluar" id="tanggal_keluar"
                            value="{{ \Carbon\Carbon::parse($karyawanKeluar->created_at)->translatedFormat('d F Y') }}"
                            readonly>
                        {{-- @if ($kontrakHabis)
                            <p>Kontrak akan habis</p>
                        @endif --}}
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="lama_kerja" class="form-label">Lama kerja :</label>
                        {{-- <p>{{ $lamaKerja->y }} Tahun, {{ $lamaKerja->m }} Bulan, {{ $lamaKerja->d }} Hari</p> --}}
                        <input type="text" class="form-control" name="lama_kerja" id="lama_kerja"
                            value="{{ $karyawanKeluar->lama_kerja }}" readonly>
                    </div>
                </div>
                <hr>
                <div class="my-3" style="font-size: 20px">
                    <h4>Identitas Karyawan</h4>
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="nama" class="form-label">Nama :</label>
                    <input type="text" class="form-control" name="nama" id="nama"
                        value="{{ $karyawanKeluar->nama }}" readonly>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="ktp" class="form-label">No. KTP :</label>
                        <input type="text" class="form-control" name="ktp" id="ktp"
                            value="{{ $karyawanKeluar->ktp }}" readonly>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="kk" class="form-label">No. KK :</label>
                        <input type="text" class="form-control" name="kk" id="kk"
                            value="{{ $karyawanKeluar->kk }}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="file_ktp" class="form-label">File KTP :</label>
                        <a href="{{ asset('storage/' . $karyawanKeluar->file_ktp) }}" target="_blank"><img
                                src="{{ asset('storage/' . $karyawanKeluar->file_ktp) }}" alt="" width="300"
                                height="150" class=" d-block rounded-3"></a>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="file_kk" class="form-label">File KK :</label>
                        <a href="{{ asset('storage/' . $karyawanKeluar->file_kk) }}" target="_blank"><img
                                src="{{ asset('storage/' . $karyawanKeluar->file_kk) }}" alt="" width="300"
                                height="150" class=" d-block rounded-3"></a>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="bpjs_kesehatan" class="form-label">No. BPJS kesehatan :</label>
                        <input type="text" class="form-control" name="bpjs_kesehatan" id="bpjs_kesehatan"
                            value="{{ $karyawanKeluar->bpjs_kesehatan }}" readonly>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="bpjs_ketenagakerjaan" class="form-label">No. BPJS Ketenagakerjaan :</label>
                        <input type="text" class="form-control" name="bpjs_ketenagakerjaan" id="bpjs_ketenagakerjaan"
                            value="{{ $karyawanKeluar->bpjs_ketenagakerjaan }}" readonly>
                    </div>
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="jenis_kelamin" class="form-label">Jenis kelamin :</label>
                    <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin"
                        value="{{ $karyawanKeluar->jenis_kelamin }}" readonly>
                </div>
                <div class="row mb-3">
                    <div class="mb-3 col-lg-6">
                        <label for="tempat_lahir" class="form-label">Tempat lahir :</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                            value="{{ $karyawanKeluar->tempat_lahir }}" readonly>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="tanggal_lahir" class="form-label">Tempat lahir :</label>
                        <input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                            value="{{ \Carbon\Carbon::parse($karyawanKeluar->tanggal_lahir)->translatedFormat('d F Y') }}"
                            readonly>
                    </div>
                </div>
                <div class="mb-3 col-lg-4">
                    <label for="agama" class="form-label">Agama :</label>
                    <input type="text" class="form-control" name="agama" id="agama"
                        value="{{ $karyawanKeluar->agama }}" readonly>
                </div>
                <div class="mb-3 col-lg-4">
                    <label for="pendidikan" class="form-label">Pendidikan :</label>
                    <input type="text" class="form-control" name="pendidikan" id="pendidikan"
                        value="{{ $karyawanKeluar->pendidikan }}" readonly>
                </div>
                <div class="row mb-3">
                    <div class="mb-3 col-lg-4">
                        <label for="telepon" class="form-label">Telepon :</label>
                        <a href="https://wa.me/{{ '62' . substr($karyawanKeluar->telepon, 1) }}" class="badge bg-success"
                            target="_blank"><i class="fa-solid fa-phone"></i></a>
                        <input type="text" class="form-control" name="telepon" id="telepon"
                            value="{{ $karyawanKeluar->telepon }}" readonly>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="email" class="form-label">Email :</label>
                        <input type="text" class="form-control" name="email" id="email"
                            value="{{ $karyawanKeluar->email }}" readonly>
                    </div>
                </div>
                <div class="mb-3 col-lg-8">
                    <label for="alamat" class="form-label">Alamat :</label>
                    <input type="text" class="form-control" name="alamat" id="alamat"
                        value="{{ $karyawanKeluar->alamat }}" readonly>
                </div>
                <hr>
                <div class="my-3" style="font-size: 20px">
                    <h4>Sosial Media</h4>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-5">
                        <label for="facebook" class="form-label">Facebook :</label>
                        <input type="facebook" class="form-control" name="facebook" id="facebook" placeholder=""
                            value="{{ $karyawanKeluar->facebook }}" readonly>
                    </div>
                    <div class="mb-3 col-lg-5">
                        <label for="instagram" class="form-label">Instagram :</label>
                        <input type="instagram" class="form-control" name="instagram" id="instagram" placeholder=""
                            value="{{ $karyawanKeluar->instagram }}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-5">
                        <label for="tiktok" class="form-label">TikTok :</label>
                        <input type="tiktok" class="form-control" name="tiktok" id="tiktok" placeholder=""
                            value="{{ $karyawanKeluar->tiktok }}">
                    </div>
                    <div class="mb-3 col-lg-5">
                        <label for="x" class="form-label">X/Twitter :</label>
                        <input type="x" class="form-control" name="x" id="x" placeholder=""
                            value="{{ $karyawanKeluar->x }}">
                    </div>
                </div>
                <hr>
                <div class="my-3" style="font-size: 20px">
                    <h4>Kontak Darurat</h4>
                </div>
                <div class="row mb-3">
                    <label for="emergency">Kontak Emergency 1</label>
                    <div class="mb-3 col-lg-4">
                        <label for="nama1" class="form-label">Nama :</label>
                        <input type="text" class="form-control" name="nama1" id="nama1"
                            value="{{ $karyawanKeluar->nama1 }}" readonly>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="status1" class="form-label">Status :</label>
                        <input type="text" class="form-control" name="status1" id="status1"
                            value="{{ $karyawanKeluar->status1 }}" readonly>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="telepon1" class="form-label">Telepon :</label>
                        <a href="https://wa.me/{{ '62' . substr($karyawanKeluar->telepon1, 1) }}"
                            class="badge bg-success" target="_blank"><i class="fa-solid fa-phone"></i></a>
                        <input type="text" class="form-control" name="telepon1" id="telepon1"
                            value="{{ $karyawanKeluar->telepon1 }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="emergency">Kontak Emergency 2</label>
                    <div class="mb-3 col-lg-4">
                        <label for="nama2" class="form-label">Nama :</label>
                        <input type="text" class="form-control" name="nama2" id="nama2"
                            value="{{ $karyawanKeluar->nama2 }}" readonly>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="status2" class="form-label">Status :</label>
                        <input type="text" class="form-control" name="status2" id="status2"
                            value="{{ $karyawanKeluar->status2 }}" readonly>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="telepon2" class="form-label">Telepon :</label>
                        <a href="https://wa.me/{{ '62' . substr($karyawanKeluar->telepon2, 1) }}"
                            class="badge bg-success" target="_blank"><i class="fa-solid fa-phone"></i></a>
                        <input type="text" class="form-control" name="telepon2" id="telepon2"
                            value="{{ $karyawanKeluar->telepon2 }}" readonly>
                    </div>
                </div>
            </div>
            {{-- </form> --}}
            <div class="card-footer d-grid gap-2 d-lg-flex justify-content-lg-end">
                {{-- <a href="/karyawankeluar" type="button" class="btn btn-success">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a> --}}
                <a href="/karyawankeluar/{{ $karyawanKeluar->id }}/cetak_pdf" type="button" class="btn btn-info"
                    style="color: white" target="_blank">
                    <i class="fa-solid fa-print"></i> Cetak
                </a>
                {{-- <a href="/karyawan/{{ $karyawan->id }}/edit" type="button" class="btn btn-warning"
                    style="color: white">
                    <i class="fa-solid fa-pen"></i> Edit
                </a> --}}
            </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
