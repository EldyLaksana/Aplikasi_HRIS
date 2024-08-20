@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Perbarui Kontrak Karyawan "{{ $karyawan->nama }}"</h1>
    </div>

    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/karyawan" style="text-decoration: none">Karyawan</a></li>
                <li class="breadcrumb-item"><a href="/karyawan/{{ $karyawan->id }}" style="text-decoration: none">Detail
                        Karyawan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Perbarui kontrak karyawan</li>
            </ol>
        </nav>
        <div class="card mb-3">
            <div class="card-header gap-2 d-grid d-lg-flex justify-content-lg-end">
                <a href="/karyawan/{{ $karyawan->id }}" type="button" class="btn btn-success">
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
                    <label for="status_pegawai" class="form-label">Status pegawai :</label>
                    <input type="text" class="form-control" name="status_pegawai" id="status_pegawai"
                        value="{{ $karyawan->status_pegawai }}" readonly>
                </div>
                <form action="/perbaruikontrak/{{ $karyawan->id }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row ">
                        <div class="mb-3 col-lg-4">
                            <label for="tanggal_masuk" class="form-label">Tanggal masuk :</label>
                            <input type="text" class="form-control" name="tanggal_masuk" id="tanggal_masuk"
                                value="{{ $karyawan->tanggal_masuk }}" readonly>
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="kontrak" class="form-label">Kontrak Karyawan :</label>
                            <input type="date" class="form-control @error('kontrak') is-invalid @enderror" name="kontrak"
                                id="kontrak" placeholder="dd/mm/yyyy" value="{{ old('kontrak', $karyawan->kontrak) }}">
                            @error('kontrak')
                                <div class="invalid-feedback">
                                    Tanggal kontrak harus diisi
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer d-grid gap-2 d-lg-flex justify-content-lg-end">
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Anda yakin memperbarui kontrak karyawan ini?')">Perbarui Kontrak <i
                                class="fa-solid fa-file-contract"></i></button>
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

        flatpickr("#kontrak", {

        });
    </script>
@endsection
