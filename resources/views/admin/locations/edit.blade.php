@extends('layout.main')

@section('title','Edit Lokasi')
@section('page-title','Edit Titik Lokasi')

@section('content')
<div class="row justify-content-start">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-map-marker-alt mr-2"></i> Form Edit Lokasi
                </h3>
            </div>

            <form action="{{ route('admin.locations.update', $location->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">

                    <div class="form-group">
                        <label><i class="fas fa-building mr-1 text-primary"></i> Nama Tempat</label>
                        <input type="text" name="name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name', $location->name) }}" 
                               required>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-align-left mr-1 text-primary"></i> Alamat Lengkap </label>
                        <textarea name="address" 
                                  class="form-control @error('address') is-invalid @enderror" 
                                  rows="3">{{ old('address', $location->address) }}</textarea>
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-map-pin mr-1 text-primary"></i> Latitude (Garis Lintang)</label>
                        <input type="text" name="latitude" 
                               class="form-control @error('latitude') is-invalid @enderror" 
                               value="{{ old('latitude', $location->latitude) }}" 
                               required>
                        @error('latitude') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-map-pin mr-1 text-primary"></i> Longitude (Garis Bujur)</label>
                        <input type="text" name="longitude" 
                               class="form-control @error('longitude') is-invalid @enderror" 
                               value="{{ old('longitude', $location->longitude) }}" 
                               required>
                        @error('longitude') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div class="card-footer d-flex justify-content-between align-items-center">
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary ml-1">
                            <i class="fas fa-arrow-left"></i> Batal
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
