@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Karyawan PT. Ratu Makmur Abadi</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Karyawan</li>
            </ol>
        </nav>
        <div class="card mb-3">
            <div class="card-header">
                <form action="/karyawan">
                    <div class="row">
                        <div class="col-lg-3 mb-2">
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
                    <table id="table1" class="table table-bordered">
                        <thead class="thead-dark">
                            <tr class="table-primary">
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
                            @foreach ($karyawans as $karyawan)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration + ($karyawans->currentPage() - 1) * $karyawans->perPage() }}
                                    </td>
                                    <td>{{ $karyawan->no_id }}</td>
                                    <td>{{ $karyawan->nama }}
                                        @if ($karyawan->sisa_kontrak)
                                            <a href="" class="" title="Kontrak hampir habis"><i
                                                    class="fa-solid fa-triangle-exclamation" style="color: red"></i></a>
                                        @endif
                                    </td>
                                    <td>{{ $karyawan->departemen->departemen }}</td>
                                    <td>{{ $karyawan->jabatan }}</td>
                                    <td>{{ $karyawan->status_pegawai }}</td>
                                    <td>
                                        {{ $karyawan->telepon }}
                                        <a href="https://wa.me/{{ '62' . substr($karyawan->telepon, 1) }}"
                                            class="badge bg-success" target="_blank"><i class="fa-solid fa-phone"></i></a>
                                    </td>
                                    <td>
                                        <a href="karyawan/{{ $karyawan->id }}" class="badge bg-primary"
                                            style="text-decoration: none" title="">
                                            <i class="fa-solid fa-magnifying-glass"></i> Detail
                                        </a>
                                        <a href="karyawan/{{ $karyawan->id }}/info" class="badge bg-info"
                                            style="text-decoration: none" title="">
                                            <i class="fa-solid fa-table"></i> Info
                                        </a>
                                        <a href="karyawan/{{ $karyawan->id }}/edit" class="badge bg-warning"
                                            style="text-decoration: none" title="">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </a>
                                        <div class="dropdown-center">
                                            <button class="badge bg-secondary border-0" data-bs-toggle="dropdown">Menu
                                                <i class="fa-solid fa-caret-down"></i></button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="/absensikaryawan/{{ $karyawan->id }}">Absensi</a></li>
                                                @if ($karyawan->baru)
                                                @else
                                                    <li><a class="dropdown-item"
                                                            href="/cutikaryawan/{{ $karyawan->id }}">Cuti</a></li>
                                                @endif
                                                <li><a class="dropdown-item"
                                                        href="/sakitkaryawan/{{ $karyawan->id }}">Sakit</a></li>
                                                <li><a class="dropdown-item"
                                                        href="/izinkaryawan/{{ $karyawan->id }}">Izin</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Paginate --}}
                    <div class="d-flex justify-content-end">
                        {{ $karyawans->links() }}
                    </div>
                    {{-- End --}}
                </div>
                {{-- End --}}
            </div>

            <div class="card-footer">
                {{-- Export excel --}}
                <div class="d-grid d-lg-flex justify-content-lg-end">
                    <a href="/exportkaryawan" type="button" class="btn btn-success" target="_blank">
                        <i class="fa-solid fa-file-excel"></i> Export
                    </a>
                </div>
                {{-- End --}}
            </div>
        </div>
    </section>
@endsection
