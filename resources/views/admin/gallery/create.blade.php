@extends('layout.main')

@section('title','Tambah Foto Galeri')
@section('page-title','Tambah Foto Galeri')

@section('content')
<div class="row justify-content-start">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Foto Galeri</h3>
            </div>

            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Upload Foto</label>
                        <input type="file" name="file" class="form-control-file @error('file') is-invalid @enderror" accept="image/*" required>
                        <small class="text-muted">Pilih file foto untuk ditambahkan ke galeri.</small>
                        @error('file') <br><span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Deskripsi (Opsional)</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Tuliskan deskripsi mengenai foto ini...">{{ old('description') }}</textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-default">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
