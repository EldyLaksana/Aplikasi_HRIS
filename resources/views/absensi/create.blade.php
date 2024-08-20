@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between felx-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Keterlambatan Karyawan "{{ $karyawan->nama }}"</h1>
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
                <li class="breadcrumb-item"><a href="/absensikaryawan/{{ $karyawan->id }}"
                        style="text-decoration: none">Keterlambatan
                        karyawan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Input Keterlambatan karyawan</li>
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
                <a href="/absensikaryawan/{{ $karyawan->id }}" type="button" class="btn btn-success"><i
                        class="fa-solid fa-arrow-left"></i> Kembali</a>
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
                <form action="/absensikaryawan" method="post">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-lg-4">
                            <label for="no_id" class="form-label">No. ID :</label>
                            <input type="text" class="form-control" name="no_id" id="no_id"
                                value="{{ $karyawan->no_id }}" readonly>
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="departemen" class="form-label">Departemen</label>
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
                    <h5>Input Keterlambatan Karyawan</h5>

                    <div class="row">
                        <div class="mb-3 col-lg-4">
                            <label for="tanggal" class="form-label">Tanggal :</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                                id="tanggal" placeholder="dd/mm/yyyy" value="{{ old('tanggal') }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    Tanggal harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="jam_masuk" class="form-label">Jam Masuk :</label>
                            <input type="time" class="form-control @error('jam_masuk') is-invalid @enderror"
                                name="jam_masuk" id="jam_masuk" placeholder="00:00" value="{{ old('jam_masuk') }}">
                            @error('jam_masuk')
                                <div class="invalid-feedback">
                                    Jam harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="jam_pulang" class="form-label">Jam Pulang :</label>
                            <input type="time" class="form-control @error('jam_pulang') is-invalid @enderror"
                                name="jam_pulang" id="jam_pulang" placeholder="00:00" value="{{ old('jam_pulang') }}">
                            @error('jam_pulang')
                                <div class="invalid-feedback">
                                    Jam harus diisi
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions d-grid d-lg-flex justify-content-lg-end">
                        <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-file-circle-plus"></i>
                            Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

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

            // dateFormat: "d/m/Y",
        });

        flatpickr("#jam_masuk", {

            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
        });

        flatpickr("#jam_pulang", {

            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
        });
    </script>
@endsection
