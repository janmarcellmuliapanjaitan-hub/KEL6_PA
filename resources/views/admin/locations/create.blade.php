@extends('layout.main')

@section('title','Tambah Lokasi')
@section('page-title','Tambah Titik Lokasi')

@section('content')
<div class="row justify-content-start">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Lokasi</h3>
            </div>

            <form action="{{ route('admin.locations.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Tempat</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Janji Martahan Utama" required>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" placeholder="Masukkan alamat cabang">{{ old('address') }}</textarea>
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Latitude (Garis Lintang)</label>
                        <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude') }}" placeholder="Contoh: -0.471852" required>
                        @error('latitude') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Longitude (Garis Bujur)</label>
                        <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude') }}" placeholder="Contoh: 117.15531" required>
                        <small class="text-muted">Anda bisa mendapatkan koordinat ini dari Google Maps dengan klik kanan pada lokasi.</small>
                        @error('longitude') <br><span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary ml-1">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
