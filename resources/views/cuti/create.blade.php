@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Cuti</h1>
    </div>
    <section class="section">
        <div class="card mb-3">
            <div class="card-header gap-2 d-grid d-lg-flex justify-content-lg-end">
                <a href="/cuti" type="button" class="btn btn-success">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
            <form action="/cuti" method="POST">
                @csrf
                <div class="card-body">
                    <div class="col-lg-4 mb-3">
                        <label for="cuti" class="form-label mt-2">Cuti :</label>
                        <input type="text" class="form-control @error('cuti') is-invalid @enderror" placeholder="Cuti"
                            name="cuti" id="cuti" required value="{{ old('cuti') }}">
                        @error('cuti')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <label for="hari" class="form-label mt-2">Hari :</label>
                        <input type="text" class="form-control @error('hari') is-invalid @enderror" placeholder="Hari"
                            name="hari" id="hari" required value="{{ old('hari') }}">
                        @error('hari')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer d-grid d-lg-flex justify-content-lg-end">
                    <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-file-circle-plus"></i>
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
