@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Cuti</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('delete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section">
        <div class="card mb-3">
            <div class="card-header d-grid d-lg-flex">
                <a href="/cuti/create" type="button" class="btn btn-success">
                    <i class="fa-solid fa-file-circle-plus"></i> Tambah Cuti
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive col-lg-8">
                    <table id="table1" class="table table-bordered ">
                        <thead class="thead-dark">
                            <tr class="table-info">
                                <th width:3% class="text-center">No</th>
                                <th>Cuti</th>
                                <th>Hari</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cutis as $cuti)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $cuti->cuti }}</td>
                                    <td>{{ $cuti->hari }} hari</td>
                                    <td>
                                        <a href="/cuti/{{ $cuti->id }}/edit" class="badge bg-warning"
                                            style="text-decoration: none" title="Edit"><i class="fa-solid fa-pen"></i>
                                            Edit
                                        </a>
                                        <form action="/cuti/{{ $cuti->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0" onclick="return confirm('Anda yakin?')"
                                                title="Hapus"><i class="fa-solid fa-trash"></i> Hapus </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
