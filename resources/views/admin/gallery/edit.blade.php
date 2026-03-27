@extends('layout.main')

@section('title','Edit Foto Galeri')
@section('page-title','Edit Foto Galeri')

@section('content')
<div class="row justify-content-start">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-edit mr-2"></i> Form Edit Foto Galeri
                </h3>
            </div>

            <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">

                    <div class="form-group">
                        <label><i class="fas fa-image mr-1 text-primary"></i> Upload Foto Baru</label>

                        @if($gallery->file_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $gallery->file_path) }}" 
                                     alt="Preview" 
                                     class="img-thumbnail shadow-sm"
                                     style="max-height: 180px; object-fit: cover;">
                                <br>
                                <small class="text-muted">Foto saat ini</small>
                            </div>
                        @endif

                        <input type="file" name="file" 
                               class="form-control-file @error('file') is-invalid @enderror" 
                               accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                        @error('file') <br><span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-align-left mr-1 text-primary"></i> Deskripsi</label>
                        <textarea name="description" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  rows="4" 
                                  placeholder="Tuliskan deskripsi mengenai foto ini...">{{ old('description', $gallery->description) }}</textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div class="card-footer d-flex justify-content-between align-items-center">
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary ml-1">
                            <i class="fas fa-arrow-left"></i> Batal
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
