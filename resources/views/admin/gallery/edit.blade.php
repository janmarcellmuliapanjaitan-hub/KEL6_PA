@extends('layout.main')

@section('title', 'Edit Foto Galeri')
@section('page-title', 'Edit Foto Galeri')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="stat-card">
            <h6 class="mb-4">Form Edit Foto Galeri</h6>
            
            <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Preview Foto Saat Ini</label>
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $gallery->file_path) }}" alt="Photo" class="img-thumbnail" style="max-height: 250px;">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Upload Foto (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" accept="image/*">
                    <div class="form-text">Pilih file baru jika ingin mengganti foto.</div>
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Tuliskan deskripsi mengenai foto ini...">{{ old('description', $gallery->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
