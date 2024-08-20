@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Izin Karyawan "{{ $karyawan->nama }}"</h1>
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
                <li class="breadcrumb-item"><a href="/karyawan" style="text-decoration: none"> Karyawan</a></li>
                <li class="breadcrumb-item"><a href="/karyawan/{{ $karyawan->id }}" style="text-decoration: none"> Detail
                        Karyawan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Izin karyawan</li>
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
                    <input type="text" class="form-control" name="nama" id="nama" value="{{ $karyawan->nama }}"
                        readonly>
                </div>

                <hr>

                <h5>Daftar izin karyawan</h5>
                <div class="gap-2 d-grid d-lg-flex justify-content-lg-start">
                    <div class="mb-3">
                        <a href="/izinkaryawan/{{ $karyawan->id }}/create" type="button" class="btn btn-success"><i
                                class="fa-solid fa-file-circle-plus"></i> Tambah</a>
                    </div>
                    @if ($izins->count() > 0)
                        <div class="mb-3">
                            <a href="/exportizin/{{ $karyawan->id }}" type="button" class="btn btn-success"
                                target="_blank">
                                <i class="fa-solid fa-file-excel"></i> Export
                            </a>
                        </div>
                    @endif
                </div>

                <div class="table-responsive col-lg-9">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr class="table-info">
                                <th class="text-center" style="width: 3%">No</th>
                                <th>Tanggal</th>
                                <th>Izin</th>
                                <th>Jam</th>
                                <th>Alasan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($izins as $izin)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($izin->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $izin->izin }}</td>
                                    @if ($izin->jam_selesai)
                                        <td>{{ \Carbon\Carbon::parse($izin->jam)->format('H:i') }} s/d
                                            {{ \Carbon\Carbon::parse($izin->jam_selesai)->format('H:i') }}</td>
                                    @else
                                        <td>{{ \Carbon\Carbon::parse($izin->jam)->format('H:i') }}</td>
                                    @endif
                                    <td>{{ $izin->alasan }}</td>
                                    <td>
                                        <a href="/izinkaryawan/{{ $izin->id }}/edit" class="badge bg-warning"
                                            style="text-decoration: none"><i class="fa-solid fa-pen"></i> Edit</a>
                                        <form action="/izinkaryawan/{{ $izin->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0"
                                                onclick="return confirm('Anda yakin?')" title="Hapus"><i
                                                    class="fa-solid fa-trash"></i> Hapus </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data izin karyawan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $izins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
