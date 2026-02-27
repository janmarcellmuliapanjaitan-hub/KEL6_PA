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
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                               value="{{ old('judul', $about->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tahun Berdiri</label>
                                <input type="text" name="tahun_berdiri" class="form-control" 
                                       value="{{ old('tahun_berdiri', $about->tahun_berdiri) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" 
                                       value="{{ old('lokasi', $about->lokasi) }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label><br>
                        @if($about->gambar)
                            <img src="{{ asset('uploads/about/'.$about->gambar) }}" width="200" class="mb-3">
                        @else
                            <p>Tidak ada gambar</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Baru (Kosongkan jika tidak ingin mengganti)</label>
                        <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format: jpeg, png, jpg. Max: 2MB</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sejarah</label>
                        <textarea name="sejarah" rows="4" class="form-control @error('sejarah') is-invalid @enderror" required>{{ old('sejarah', $about->sejarah) }}</textarea>
                        @error('sejarah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Visi</label>
                        <textarea name="visi" rows="3" class="form-control @error('visi') is-invalid @enderror" required>{{ old('visi', $about->visi) }}</textarea>
                        @error('visi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Misi</label>
                        <textarea name="misi" rows="3" class="form-control @error('misi') is-invalid @enderror" required>{{ old('misi', $about->misi) }}</textarea>
                        @error('misi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection