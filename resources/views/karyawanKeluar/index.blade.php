@extends('dashboard.layouts.main')

@section('container')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Karyawan Keluar</h1>
    </div>

    <section class="section">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Karyawan keluar</li>
            </ol>
        </nav>
        <div class="card mb-3">
            <div class="card-header">
                <form action="/karyawankeluar">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari ..." name="cari"
                                    value="{{ request('cari') }}">
                                <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa fa-search"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group mb-3">
                                <select class="form-select" id="departemen" name="departemen">
                                    <option selected value="">Departemen ...</option>
                                    @foreach ($departemen as $departemen)
                                        <option value="{{ $departemen->id }}"
                                            {{ request('departemen') == $departemen->id ? 'selected' : '' }}>
                                            {{ $departemen->departemen }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa fa-search"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="card-body">
                {{-- Tabel --}}
                <div class="table-responsive">
                    <table id="table1" class="table table-bordered ">
                        <thead class="thead-dark">
                            <tr class="table-danger">
                                <th class="text-center">No</th>
                                <th>Nomor ID</th>
                                <th>Nama Karyawan</th>
                                <th>Departemen</th>
                                <th>Jabatan</th>
                                <th>Status Pegawai</th>
                                <th>No. Telepon</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($karyawanKeluars as $karyawanKeluar)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration + ($karyawanKeluars->currentPage() - 1) * $karyawanKeluars->perPage() }}
                                    </td>
                                    <td>{{ $karyawanKeluar->no_id }}</td>
                                    <td>{{ $karyawanKeluar->nama }}</td>
                                    <td>{{ $karyawanKeluar->departemen->departemen }}</td>
                                    <td>{{ $karyawanKeluar->jabatan }}</td>
                                    <td>{{ $karyawanKeluar->status_pegawai }}</td>
                                    <td>
                                        {{ $karyawanKeluar->telepon }}
                                        <a href="https://wa.me/{{ '62' . substr($karyawanKeluar->telepon, 1) }}"
                                            class="badge bg-success" target="_blank"><i class="fa-solid fa-phone"></i></a>
                                    </td>
                                    <td>
                                        <a href="karyawankeluar/{{ $karyawanKeluar->id }}" class="badge bg-primary"
                                            style="text-decoration: none" title="">
                                            <i class="fa-solid fa-magnifying-glass"></i> Detail
                                        </a>
                                        <form action="/karyawankeluar/{{ $karyawanKeluar->id }}" method="POST"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0"
                                                onclick="return confirm('Anda yakin menghapus karyawan ini?')"><i
                                                    class="fa-solid fa-trash"></i>
                                                Hapus</button>
                                        </form>
                                        {{-- <a href="karyawan/{{ $karyawan->id }}/edit" class="badge bg-warning"
                                            style="text-decoration: none" title="">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- End --}}

                {{-- Paginate --}}
                <div class="d-flex justify-content-end">
                    {{ $karyawanKeluars->links() }}
                </div>
                {{-- End --}}
            </div>
            <div class="card-footer">
                {{-- Export excel --}}
                <div class="d-grid d-lg-flex justify-content-lg-end">
                    <a href="/exportkaryawankeluar" type="button" class="btn btn-success" target="_blank">
                        <i class="fa-solid fa-file-excel"></i> Export
                    </a>
                </div>
                {{-- End --}}
            </div>
        </div>
    </section>
@endsection
