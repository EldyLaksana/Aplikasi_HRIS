@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Cuti Karyawan "{{ $karyawan->nama }}"</h1>
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
                <li class="breadcrumb-item"><a href="/cutikaryawan/{{ $karyawan->id }}" style="text-decoration: none">Cuti
                        Karyawan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Input Cuti Karyawan</li>
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
                        <li><a class="dropdown-item" href="/peringatankaryawan/{{ $karyawan->id }}">Izin</a></li>
                    </ul>
                </div>
                <a href="/cutikaryawan/{{ $karyawan->id }}" type="button" class="btn btn-success"><i
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
                <form action="/cutikaryawan" method="post">
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
                    <h5>Input Cuti Karyawan</h5>

                    @if ($jatahCuti <= 0)
                        <div class="alert alert-danger" role="alert">
                            Sisa cuti tahunan habis
                        </div>
                    @else
                        <div class="alert alert-success" role="alert">
                            Sisa cuti tahunan: {{ $jatahCuti }}
                        </div>
                    @endif

                    <div class="mb-3 col-lg-4">
                        <label for="cuti" class="form-label">Cuti :</label>
                        <select name="cuti" id="cuti" class="form-select" onchange="checkCuti()">
                            @foreach ($cutis as $cuti)
                                @if (old('cuti') == $cuti->cuti)
                                    <option value="{{ $cuti->cuti }}" selected>{{ $cuti->cuti }},
                                        {{ $cuti->hari }} hari</option>
                                @else
                                    <option value="{{ $cuti->cuti }}">{{ $cuti->cuti }}, {{ $cuti->hari }} hari
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-4">
                            <label for="tanggal_cuti" class="form-label">Tanggal cuti :</label>
                            <input type="date" class="form-control @error('tanggal_cuti') is-invalid @enderror"
                                name="tanggal_cuti" id="tanggal_cuti" placeholder="dd/mm/yyyy"
                                value="{{ old('tanggal_cuti') }}" required>
                            @error('tanggal_cuti')
                                <div class="invalid-feedback">
                                    Tanggal cuti harus diisi
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="jumlah_hari" class="form-label">Jumlah hari :</label>
                            <input type="number" class="form-control" name="jumlah_hari" id="jumlah_hari"
                                value="0" readonly>
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
        var maxNumberOfDates = {{ $jatahCuti }};
        var selectedDates = [];

        flatpickr("#tanggal_cuti", {
            "disable": [
                function(date) {
                    return (date.getDay() === 0 || date.getDay() === 7);
                }
            ],
            "locale": {
                "firstDayOfWeek": 1
            },
            mode: "multiple",
            dateFormat: "d/m/Y",

            onChange: function(selectedDates, dateStr, instance) {
                document.getElementById("jumlah_hari").value = selectedDates.length;
                if (selectedDates.length > maxNumberOfDates) {
                    instance.clear();
                    document.getElementById('dataError').innerText = "Jumlah hari melebihi batas"
                } else {
                    document.getElementById('dataError').innerText = '';
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            checkCuti();
        });

        function checkCuti() {
            var jatahCuti = @json($jatahCuti); // Ambil nilai jatah cuti dari Blade
            var jenisCuti = document.getElementById('jenisCuti').value;
            var tambahButton = document.getElementById('tambahButton');

            if (jatahCuti < 1 && jenisCuti === 'cuti_tahunan') {
                tambahButton.style.display = 'none';
            } else {
                tambahButton.style.display = 'block';
            }
        }
    </script>
@endsection
