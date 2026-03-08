@extends('layouts.admin')

@section('title', 'Edit About Us')
@section('page-title', 'Edit About Us')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Judul Halaman <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', $about->judul) }}" required>
                    </div>

                    @if($about->gambar)
                    <div class="mb-3">
                        <label>Gambar Saat Ini</label><br>
                        <img src="{{ asset('uploads/about/'.$about->gambar) }}" width="200" class="mb-2">
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Gambar Baru (kosongkan jika tidak ingin mengganti)</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Lengkap <span class="text-danger">*</span></label>
                        
                        
                        <textarea name="deskripsi" rows="20" class="form-control" required>{{ old('deskripsi', $about->deskripsi) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection