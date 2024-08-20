@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Sakit Karyawan "{{ $karyawan->nama }}"</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/karyawan" style="text-decoration: none">Karyawan</a></li>
                <li class="breadcrumb-item"><a href="/karyawan/{{ $karyawan->id }}" style="text-decoration: none">Detail
                        karyawan</a></li>
                <li class="breadcrumb-item"><a href="/sakitkaryawan/{{ $karyawan->id }}" style="text-decoration: none">Sakit
                        karyawan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Sakit karyawan</li>
            </ol>
        </nav>
        <div class="card mb-3">
            <div class="card-header gap-2 d-grid d-lg-flex justify-content-lg-end">
                <div class="dropdown-center d-grid">
                    <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown">Menu <i
                            class="fa-solid fa-caret-down"></i></button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/absensikaryawan/{{ $karyawan->id }}">Absensi</a></li>
                        @if ($karyawan->baru)
                        @else
                            <li><a class="dropdown-item" href="/cutikaryawan/{{ $karyawan->id }}">Cuti</a></li>
                        @endif
                        <li><a class="dropdown-item" href="/sakitkaryawan/{{ $karyawan->id }}">Sakit</a></li>
                        <li><a class="dropdown-item" href="/izinkaryawan/{{ $karyawan->id }}">Izin</a></li>
                    </ul>
                </div>
                <a href="/sakitkaryawan/{{ $karyawan->id }}" type="button" class="btn btn-success">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    @if ($karyawan->foto)
                        <img src="{{ asset('storage/' . $karyawan->foto) }}" alt="" width="200" height="200"
                            class="border rounded-3">
                    @else
                        <img src="/img/blank-profile2.png" alt="" width="200" height="200"
                            class="border rounded-3">
                    @endif
                </div>
                <form action="/sakitkaryawan/{{ $sakit->id }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-lg-4">
                            <label for="no_id" class="form-label">No. ID :</label>
                            <input type="text" class="form-control" name="no_id" id="no_id"
                                value="{{ $karyawan->no_id }}" readonly>
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="departemen" class="form-label">Departemen :</label>
                            <input type="text" class="form-control" name="departemen" id="departemen"
                                value="{{ $karyawan->departemen->departemen }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="nama" class="form-label">Nama :</label>
                        <input type="text" class="form-control" name="nama" id="nama"
                            value="{{ $karyawan->nama }}" readonly>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <input type="text" class="form-control" name="karyawan_id" id="karyawan_id"
                            value="{{ $karyawan->id }}" readonly hidden>
                    </div>

                    <hr>
                    <h5>Edit Sakit Karyawan</h5>
                    <div class="row mb-3">
                        <div class="mb-3 col-lg-4">
                            <label for="tanggal" class="form-label">Tanggal :</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                                id="tanggal" placeholder="dd/mm/yyyy" value="{{ old('tanggal', $sakit->tanggal) }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    Tanggal harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="tanggal" class="form-label" style="color: white">Tanggal :</label>
                            <p class="form-control">{{ $sakit->tanggal }}</p>
                        </div>
                    </div>


                    <div class="mb-3 col-lg-6">
                        <label for="keterangan" class="form-label">Keterangan :</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                            name="keterangan" id="keterangan" value="{{ old('keterangan', $sakit->keterangan) }}">
                        @error('keterangan')
                            <div class="invalid-feedback">
                                Keterangan harus diisi
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="file" class="form-label">Surat keterangan sakit</label>
                        <input type="hidden" name="fileLama" id="" value="{{ $sakit->file }}">
                        <div class="mb-3">
                            @if ($sakit->file)
                                <img src="{{ asset('storage/' . $sakit->file) }}" alt="" width="300"
                                    height="400" class="file_preview d-block">
                            @else
                                <img class="gambar-preview img-fluid mb-3 col-sm-6">
                            @endif
                        </div>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file"
                            id="file" onchange="previewFile()">
                        @error('file')
                            <div class="invalid-feedback">
                                File tidak boleh lebih dari 2 mb
                            </div>
                        @enderror
                    </div>

                    <div class="form-actions d-grid d-lg-flex justify-content-lg-end">
                        <button type="submit" class="btn btn-warning" style="color: white"> <i
                                class="fa-solid fa-pen"></i>
                            Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

    <script>
        var dateTimeInput = document.getElementById("tanggal");

        flatpickr("#tanggal", {
            "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 7);

                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            },

            mode: "multiple",
            dateFormat: "d/m/Y",
        });
    </script>

    <script>
        function previewFile() {
            const file = document.querySelector('#file');
            const filePreview = document.querySelector('.file_preview');

            filePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(file.files[0]);

            oFReader.onload = function(oFREvent) {
                filePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
