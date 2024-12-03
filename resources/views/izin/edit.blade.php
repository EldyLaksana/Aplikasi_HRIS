@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowarp align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Izin Karyawan "{{ $karyawan->nama }}"</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="Alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/karyawan" style="text-decoration: none">Karyawan</a></li>
                <li class="breadcrumb-item"><a href="/karyawan/{{ $karyawan->id }}" style="text-decoration: none">Detail
                        Karyawan</a></li>
                <li class="breadcrumb-item"><a href="/izinkaryawan/{{ $karyawan->id }}" style="text-decoration: none">Izin
                        Karyawan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Izin Karyawan</li>
            </ol>
        </nav>
        <div class="card mb-3">
            <div class="card-header gap-2 d-grid d-lg-flex justify-content-lg-end">
                <div class="dropdown-center d-grid">
                    <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown">Menu <i
                            class="fa-solid fa-caret-down"></i></button>
                    <ul class="dropdown-menu">
                        {{-- <li><a class="dropdown-item" href="/absensikaryawan/{{ $karyawan->id }}">Absensi</a></li> --}}
                        @if ($karyawan->baru)
                        @else
                            <li><a class="dropdown-item" href="/cutikaryawan/{{ $karyawan->id }}">Cuti</a></li>
                        @endif
                        <li><a class="dropdown-item" href="/sakitkaryawan/{{ $karyawan->id }}">Sakit</a></li>
                        <li><a class="dropdown-item" href="/izinkaryawan/{{ $karyawan->id }}">Izin</a></li>
                        <li><a class="dropdown-item" href="/peringatankaryawan/{{ $karyawan->id }}">Peringatan</a></li>
                    </ul>
                </div>
                <a href="/izinkaryawan/{{ $karyawan->id }}" type="button" class="btn btn-success"><i
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
                <form action="/izinkaryawan/{{ $izin->id }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-lg-4">
                            <label for="no_id" class="form-label">No. ID :</label>
                            <input type="text" name="no_id" id="no_id" class="form-control"
                                value="{{ $karyawan->no_id }}" readonly>
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="departemen" class="form-label">Departemen :</label>
                            <input type="text" name="departemen" id="departemen" class="form-control"
                                value="{{ $karyawan->departemen->departemen }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="nama" class="form-label">Nama :</label>
                        <input type="text" name="nama" id="nama" class="form-control"
                            value="{{ $karyawan->nama }}" readonly>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <input type="text" class="form-control" name="karyawan_id" id="karyawan_id"
                            value="{{ $karyawan->id }}" readonly hidden>
                    </div>
                    <hr>
                    <h5>Input Izin Karyawan</h5>

                    <div class="mb-3 col-lg-4">
                        <label for="tanggal" class="form-label">Tanggal :</label>
                        <input type="date" name="tanggal" id="tanggal"
                            class="form-control @error('tanggal') is-invalid @enderror" placeholder="dd/mm/yyyy"
                            value="{{ old('tanggal', $izin->tanggal) }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback">
                                Tanggal harus diisi
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-4">
                            <label for="izin" class="form-label">Izin :</label>
                            <select name="izin" id="izin" class="form-select">

                                <option value="Tidak masuk bekerja"
                                    {{ $izin->izin == 'Tidak masuk bekerja' ? 'selected' : '' }}>Tidak masuk bekerja
                                </option>
                                <option value="Tidak absen masuk"
                                    {{ $izin->izin == 'Tidak absen masuk' ? 'selected' : '' }}>Tidak absen masuk
                                </option>
                                <option value="Tidak absen pulang"
                                    {{ $izin->izin == 'Tidak absen pulang' ? 'selected' : '' }}>Tidak absen pulang</option>
                                <option value="Datang terlambat"
                                    {{ $izin->izin == 'Datang terlambat' ? 'selected' : '' }}>Datang terlambat</option>
                                <option value="Pulang lebih awal"
                                    {{ $izin->izin == 'Pulang lebih awal' ? 'selected' : '' }}>Pulang lebih awal</option>
                                <option value="Keluar saat jam kerja"
                                    {{ $izin->izin == 'Keluar saat jam kerja' ? 'selected' : '' }}>Keluar saat jam kerja
                                </option>
                                <option value="Lupa absen masuk"
                                    {{ $izin->izin == 'Lupa absen masuk' ? 'selected' : '' }}>Lupa absen masuk</option>
                                <option value="Lupa absen pulang"
                                    {{ $izin->izin == 'Lupa absen pulang' ? 'selected' : '' }}>Lupa absen pulang</option>
                                <option value="Tugas di kantor lain"
                                    {{ $izin->izin == 'Tugas di kantor lain' ? 'selected' : '' }}>Tugas di kantor lain
                                </option>
                                <option value="Kegiatan lain" {{ $izin->izin == 'Kegiatan lain' ? 'selected' : '' }}>
                                    Kegiatan lain</option>

                            </select>
                        </div>
                        <div class="mb-3 col-lg-4" id="jam" style="display: none">
                            <label for="jam" class="form-label">Jam :</label>
                            <input type="time" name="jam" id="jam" class="form-control"
                                value="{{ old('jam', $izin->jam) }}">
                        </div>
                        <div class="mb-3 col-lg-4" id="jam_selesai" style="display: none">
                            <label for="jam_selesai" class="form-label">Jam selesai:</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control"
                                value="{{ old('jam_selesai', $izin->jam_selesai) }}">
                        </div>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="alasan" class="form-label">Alasan :</label>
                        <textarea name="alasan" id="alasan" rows="3" class="form-control" required>{{ old('alasan', $izin->alasan) }}</textarea>
                    </div>
                    <div class="form-actions d-grid d-lg-flex justify-content-lg-end">
                        <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-file-circle-plus"></i>
                            Tambah</button>
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

            // mode: "multiple",
            // dateFormat: "d/m/Y",
        });

        flatpickr("#jam", {
            enableTime: true,
            time_24hr: true,
            noCalendar: true,
            dateFormat: "H:i",
            // defaultDate: "00:00",
        });

        flatpickr("#jam_selesai", {
            enableTime: true,
            time_24hr: true,
            noCalendar: true,
            dateFormat: "H:i",
            // defaultDate: "00:00",
        });
    </script>

    <script>
        function updateVisibility() {
            var selectValue = document.getElementById('izin').value;
            var jam = document.getElementById('jam');
            var jam_selesai = document.getElementById('jam_selesai');

            var opsiJam = ['Datang terlambat', 'Pulang lebih awal', 'Lupa absen masuk', 'Lupa absen pulang',
                'Kegiatan lain'
            ];
            var opsiJamSelesai = ['Keluar saat jam kerja', 'Tugas di kantor lain'];

            if (opsiJam.includes(selectValue)) {
                jam.style.display = 'block';
            } else {
                jam.style.display = 'none';
            }

            if (opsiJamSelesai.includes(selectValue)) {
                jam.style.display = 'block';
                jam_selesai.style.display = 'block';
            } else {
                jam_selesai.style.display = 'none';
            }
        }

        document.getElementById('izin').addEventListener('change', updateVisibility);

        // Call updateVisibility when the page loads to set initial visibility based on the selected value
        document.addEventListener('DOMContentLoaded', function() {
            updateVisibility();
        });
    </script>
@endsection
