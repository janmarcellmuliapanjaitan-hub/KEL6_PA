@extends('layouts.admin')

@section('title', 'Tambah About Us')
@section('page-title', 'Tambah About Us')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Judul Halaman <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', 'Tentang Janji Martahan Coffee') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                        <small class="text-muted">Format: jpeg, png, jpg. Max: 2MB</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Lengkap <span class="text-danger">*</span></label>
                        
                        <div class="alert alert-info">
                            <strong>Panduan Format:</strong>
                            <ul class="mb-0">
                                <li><code># Judul Utama</code> - untuk judul besar</li>
                                <li><code>## Sub Judul</code> - untuk sub judul</li>
                                <li><code>- teks</code> - untuk bullet point</li>
                                <li><code>&lt;br&gt;</code> - untuk baris baru</li>
                                <li><code>**teks**</code> - untuk teks tebal (bold)</li>
                            </ul>
                        </div>
                        
                        <textarea name="deskripsi" rows="20" class="form-control" required placeholder=>{{ old('deskripsi') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection