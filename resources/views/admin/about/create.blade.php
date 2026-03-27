@extends('layout.main')
@section('title','Tambah About Us')
@section('page-title','Tambah About Us')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Form Tambah About Us</h3>
            </div>

            <form action="{{ route('admin.about.store') }}" 
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label>Judul</label>

                        <input type="text"
                               name="judul"
                               class="form-control"
                               value="{{ old('judul') }}"
                               placeholder="Masukkan judul"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>

                        <textarea name="deskripsi"
                                  rows="8"
                                  class="form-control"
                                  placeholder="Masukkan deskripsi"
                                  required>{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Gambar</label>

                        <input type="file"
                               name="gambar"
                               class="form-control"
                               required>
                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="{{ route('admin.about.index') }}" 
                       class="btn btn-secondary">
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection