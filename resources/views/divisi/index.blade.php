@extends('dashboard.layouts.main')

@section('container')
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

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Divisi</h1>
    </div>

    <section class="section">
        <div class="card mb-3">
            <div class="card-header">
                <a href="#" type="button" class="btn btn-success btn-sm" onclick="showTambahDivisi()">
                    Tambah Divisi
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive col-lg-9">
                    <table id="table1" class="table table-bordered table-stripted ">
                        <thead class="thead-dark">
                            <tr>
                                <th width:3% class="text-center">No</th>
                                <th>Kode Divisi</th>
                                <th>Nama Divisi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($divisi as $divisi)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $divisi->kode_divisi }}</td>
                                    <td>{{ $divisi->divisi }}</td>
                                    <td>
                                        <a href="#" class="badge bg-warning"><i class="fa-solid fa-pen"
                                                onclick="showEditDivisi()" title="Edit"></i></a>
                                        <form action="/divisi/{{ $divisi->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0" onclick="return confirm('Anda yakin?')"
                                                title="Hapus"><i class="fa-solid fa-trash"></i></button>
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

    {{-- Modal tambah divisi --}}
    <div class="modal fade" id="tambahDivisi" tabindex="-1" role="dialog" aria-labelledby="tambahDivisiLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDivisiLabel">Tambah Divisi</h5>
                    <button type="button" class="btn-close" onclick="$('#tambahDivisi').modal('hide')" aria-label="Close">
                    </button>
                </div>
                <form action="/divisi" method="POST" id="formUpdateDivisi">
                    @csrf
                    <div class="modal-body">
                        <label for="divisi" class="form-label mt-2">Divisi :</label>
                        <input type="text" class="form-control @error('divisi') is-invalid @enderror"
                            placeholder="Divisi" name="divisi" id="divisi" required value="{{ old('divisi') }}">
                        @error('divisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="kode_divisi" class="form-label mt-2">Kode Divisi :</label>
                        <input type="text" class="form-control @error('divisi') is-invalid @enderror"
                            placeholder="Kode Divisi" name="kode_divisi" id="kode_divisi" required
                            value="{{ old('kode_divisi') }}">
                        @error('kode_divisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal edit divisi --}}
    <div class="modal fade" id="editDivisi" tabindex="-1" role="dialog" aria-labelledby="editDivisiLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDivisiLabel">Edit Divisi</h5>
                    <button type="button" class="btn-close" onclick="$('#editDivisi').modal('hide')" aria-label="Close">
                    </button>
                </div>
                <form action="/divisi/{{ $divisi->id }}" method="POST" id="formEditDivisi">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <label for="divisi" class="form-label mt-2">Divisi :</label>
                        <input type="text" class="form-control @error('divisi') is-invalid @enderror"
                            placeholder="Divisi" name="divisi" id="divisi" required value="{{ old('divisi') }}">
                        @error('divisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="kode_divisi" class="form-label mt-2">Kode Divisi :</label>
                        <input type="text" class="form-control @error('divisi') is-invalid @enderror"
                            placeholder="Kode Divisi" name="kode_divisi" id="kode_divisi" required
                            value="{{ old('kode_divisi') }}">
                        @error('kode_divisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function showTambahDivisi() {
            $('#tambahDivisi').modal('show');
        }
    </script>

    <script>
        function showEditDivisi() {
            $('#editDivisi').modal('show');
        }
    </script>

    {{-- <script>
        function showEditDivisi(data) {
            console.log(data);
            let editdivisiModal = document.getElementById(editDivisi');
            $('#divisi').text(data.divisi);
            $('#kode_divisi').text(data.kode_divisi);
            $('#editDivisi').modal('show');
        }
    </script> --}}
@endsection
