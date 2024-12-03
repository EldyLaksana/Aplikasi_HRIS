@extends('dashboard.layouts.main')

@section('container')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Info Karyawan "{{ $karyawan->nama }}"</h1>
    </div>
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/karyawan" style="text-decoration: none">Karyawan</a></li>
                <li class="breadcrumb-item"><a href="/karyawan/{{ $karyawan->id }}" style="text-decoration: none">Detail
                        karyawan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Info karyawan</li>
            </ol>
        </nav>
        <div class="card mb-3">
            {{-- Kembali ke detail karyawan --}}
            <div class="card-header gap-2 d-grid d-lg-flex justify-content-lg-end">
                {{-- Dropdown menu --}}
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
                    </ul>
                </div>
                {{-- End --}}
                <a href="/karyawan/{{ $karyawan->id }}" type="button" class="btn btn-success">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
            {{-- End --}}
            <div class="card-body">
                {{-- Detail karyawan --}}
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
                <div class="mb-3 col-lg-6">
                    {{-- <label for="karyawan_id" class="form-label">ID :</label> --}}
                    <input type="text" class="form-control" name="karyawan_id" id="karyawan_id"
                        value="{{ $karyawan->id }}" readonly hidden>
                </div>
                {{-- End --}}
                <hr>
                {{-- Tabel informasi --}}
                <div class="row gap-5 mt-4 mb-4">
                    <div class="card col-lg-5 border-secondary">
                        <div class="card-body">
                            <h5 class="card-text mt-3">Cuti | Sisa cuti tahunan : {{ $jatahCuti }}</h5>
                            <div class="table-responsive mt-3">
                                <table id="table1" class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr class="table-success">
                                            <th class="text-center">No</th>
                                            <th>Cuti</th>
                                            <th>Tanggal</th>
                                            <th>Hari</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cutiKaryawans as $cutiKaryawan)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $cutiKaryawan->cuti }}</td>
                                                <td>{{ $cutiKaryawan->tanggal_cuti }}</td>
                                                <td>{{ $cutiKaryawan->jumlah_hari }}</td>
                                                {{-- <td>{{ $jatahCuti }}</td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $cutiKaryawans->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-lg-5 border-secondary">
                        <div class="card-body">
                            <h5 class="card-text mt-3">Keterlambatan</h5>
                            <div class="table-responsive mt-3">
                                <table id="table1" class="table table-bordered ">
                                    <thead class="thead-dark">
                                        <tr class="table-warning">
                                            <th class="text-center">No</th>
                                            <th>Tanggal</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Pulang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensis as $absensi)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($absensi->jam_masuk)->format('H:i') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($absensi->jam_pulang)->format('H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $absensis->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End --}}
                </div>
                <div class="row gap-5 mt-4 mb-4">
                    <div class="card col-lg-5 border-secondary">
                        <div class="card-body">
                            <h5 class="card-text mt-3">Sakit</h5>
                            <div class="table-responsive mt-3">
                                <table id="table1" class="table table-bordered table-stipted">
                                    <thead class="thead-dark">
                                        <tr class="table-info">
                                            <th width:3% class="text-center">No</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Surat izin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sakits as $sakit)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $sakit->tanggal }}</td>
                                                <td>{{ $sakit->keterangan }}</td>
                                                <td>
                                                    @if ($sakit->file)
                                                        <a href="{{ asset('storage/' . $sakit->file) }}" target="_blank"
                                                            type="button" class="btn btn-success"> Lihat
                                                            file</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $sakits->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-lg-5 border-secondary">
                        <div class="card-body">
                            <h5 class="card-text mt-3">Izin</h5>
                            <div class="table-responsive mt-3">
                                <table id="table1" class="table table-bordered table-stipted">
                                    <thead class="thead-dark">
                                        <tr class="table-info">
                                            <th width:3% class="text-center">No</th>
                                            <th>Tanggal</th>
                                            <th>Izin</th>
                                            <th>Jam</th>
                                            <th>Alasan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($izins as $izin)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ \Carbon\Carbon::parse($izin->tanggal)->translatedFormat('d F Y') }}
                                                </td>
                                                <td>{{ $izin->izin }}</td>
                                                @if ($izin->jam_selesai)
                                                    <td>{{ \Carbon\Carbon::parse($izin->jam)->format('H:i') }} s/d
                                                        {{ \Carbon\Carbon::parse($izin->jam_selesai)->format('H:i') }}</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($izin->jam)->format('H:i') }}</td>
                                                @endif
                                                <td>{{ $izin->alasan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $izins->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
