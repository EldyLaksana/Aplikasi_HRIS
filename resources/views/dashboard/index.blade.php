@extends('dashboard.layouts.main')

@section('container')
    <style>
        .kartu {
            width: 18rem;
        }

        @media (max-width: 768px) {
            .kartu {
                width: 100%;
                margin: 0 auto;
            }
        }
    </style>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Selamat Datang di Aplikasi HRIS | PT. Ratu Makmur Abadi</h1>
    </div>
    <div class="container mt-2">
        <div class="row gap-4">
            <div class="card kartu text-center text-bg-success ">
                <div class="card-body">
                    <i class="fa-solid fa-user fa-2xl mb-3 mt-4"></i>
                    <hr>
                    <h5 class="card-text mt-3">Jumlah Karyawan</h5>
                    <h5 class="card-text">{{ $jumlahKaryawan }}</h5>
                </div>
            </div>
            <div class="card kartu text-center text-bg-danger ">
                <div class="card-body">
                    <i class="fa-solid fa-user-slash fa-2xl mb-3 mt-4"></i>
                    <hr>
                    <h5 class="card-text mt-3">Jumlah Karyawan Keluar</h5>
                    <h5 class="card-text">{{ $jumlahKaryawanKeluar }}</h5>
                </div>
            </div>
        </div>
        <div class="row gap-3 mt-4 mb-4">
            <div class="card col-lg-5 border-secondary">
                <div class="card-body">
                    <h5 class="card-text mt-3">Jumlah Karyawan Berdasarkan Departemen</h5>
                    <div class="table-responsive mt-3">
                        <table id="table1" class="table table-bordered">
                            <thead class="thead-dark">
                                <tr class="table-success">
                                    <th class="text-center">No</th>
                                    <th>Departemen</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departemens as $departemen)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $departemen->departemen }}</td>
                                        <td>{{ $departemen->karyawan_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card col-lg-5 border-secondary">
                <div class="card-body">
                    <h5 class="card-text mt-3">Kontrak Akan Habis</h5>
                    <div class="table-responsive mt-3">
                        <table id="table1" class="table table-bordered ">
                            <thead class="thead-dark">
                                <tr class="table-warning">
                                    <th class="text-center">No</th>
                                    <th>Nama</th>
                                    <th>Departemen</th>
                                    <th>Kontrak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawanAkanHabis as $karyawan)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $karyawan->nama }}</td>
                                        <td>{{ $karyawan->departemen->departemen }}</td>
                                        <td>{{ \Carbon\Carbon::parse($karyawan->kontrak)->translatedFormat('d F Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
