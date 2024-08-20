@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Departemen</h1>
    </div>
    <section class="section">
        <div class="card mb-3">
            <div class="card-header gap-2 d-grid d-lg-flex justify-content-lg-end">
                <a href="/departemen" type="button" class="btn btn-success">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
            <form action="/departemen/{{ $departemen->id }}" method="post">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="col-lg-4 mb-3">
                        <label for="departemen" class="form-label">Departemen :</label>
                        <input type="text" class="form-control @error('departemen') is-invalid @enderror" placeholder=""
                            name="departemen" id="departemen" value="{{ old('departemen', $departemen->departemen) }}"
                            required>
                        @error('departemen')
                            <div class="invalid-feedback">
                                Harus diisi
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer d-grid d-lg-flex justify-content-lg-end">
                    <button type="submit" class="btn btn-warning" style="color: white"> <i class="fa-solid fa-pen"></i>
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
