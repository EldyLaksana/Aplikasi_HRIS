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
        <h1 class="h2">Daftar Jabatan</h1>
    </div>

    <section class="section">
        <div class="card mb-3">
            <div class="card-header">
                <a href="#" type="button" class="btn btn-success btn-sm" onclick="showTambahJabatan()">
                    Tambah Jabatan
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive col-lg-9">
                    <table id="table1" class="table table-bordered table-stripted ">
                        <thead class="thead-dark">
                            <tr>
                                <th width:3% class="text-center">No</th>
                                <th>Jabatan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jabatan as $jabatan)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $jabatan->jabatan }}</td>
                                    <td>
                                        <a href="#" class="badge bg-warning" title="Edit"><i class="fa-solid fa-pen"
                                                onclick="showEditJabatan()"></i></a>
                                        <form action="/jabatan/{{ $jabatan->id }}" method="POST" class="d-inline">
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

    {{-- Modal tambah jabatan --}}
    <div class="modal fade" id="tambahJabatan" tabindex="-1" role="dialog" aria-labelledby="tambahJabatanLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahJabatanLabel">Tambah Jabatan</h5>
                    <button type="button" class="btn-close" onclick="$('#tambahJabatan').modal('hide')" aria-label="Close">
                    </button>
                </div>
                <form action="/jabatan" method="POST" id="formUpdateJabatan">
                    @csrf
                    <div class="modal-body">
                        <label for="jabatan" class="form-label mt-2">Jabatan :</label>
                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                            placeholder="Jabatan" name="jabatan" id="jabatan" required value="{{ old('jabatan') }}">
                        @error('jabatan')
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
    <div class="modal fade" id="editJabatan" tabindex="-1" role="dialog" aria-labelledby="editJabatanLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editJabatanLabel">Edit Jabatan</h5>
                    <button type="button" class="btn-close" onclick="$('#editJabatan').modal('hide')" aria-label="Close">
                    </button>
                </div>
                <form action="/jabatan/{{ $jabatan->id }}" method="POST" id="formEditJabatan">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <label for="jabatan" class="form-label mt-2">Divisi :</label>
                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                            placeholder="Jabatan" name="jabatan" id="jabatan" required value="{{ old('jabatan') }}">
                        @error('jabatan')
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
        function showTambahJabatan() {
            $('#tambahJabatan').modal('show');
        }
    </script>

    <script>
        function showEditJabatan() {
            $('#editJabatan').modal('show');
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
