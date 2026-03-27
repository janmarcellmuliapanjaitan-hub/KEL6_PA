@extends('layout.main')

@section('title','Edit Promo')
@section('page-title','Edit Promo')

@section('content')
<div class="row justify-content-start">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-edit mr-2"></i> Form Edit Promo
                </h3>
            </div>

            <form action="{{ route('admin.promo.update', $promo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">

                    <div class="form-group">
                        <label><i class="fas fa-heading mr-1 text-primary"></i> Judul Promo</label>
                        <input type="text" name="title" 
                               class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title', $promo->title) }}" 
                               placeholder="Masukkan judul promo"
                               required>
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-align-left mr-1 text-primary"></i> Deskripsi</label>
                        <textarea name="description" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  rows="4" 
                                  placeholder="Masukkan deskripsi promo"
                                  required>{{ old('description', $promo->description) }}</textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-calendar-alt mr-1 text-primary"></i> Berlaku Sampai <span class="text-muted">(Opsional)</span></label>
                        <input type="date" name="valid_until" 
                               class="form-control @error('valid_until') is-invalid @enderror" 
                               value="{{ old('valid_until', $promo->valid_until ? \Carbon\Carbon::parse($promo->valid_until)->format('Y-m-d') : '') }}">
                        <small class="text-muted">Kosongkan jika promo berlaku selamanya.</small>
                        @error('valid_until') <br><span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-image mr-1 text-primary"></i> Gambar Promo</label>

                        @if($promo->image)
                            <div class="mb-2">
                                <img src="{{ Storage::url($promo->image) }}" 
                                     alt="Preview" 
                                     class="img-thumbnail shadow-sm"
                                     style="max-height: 180px; object-fit: cover;">
                                <br>
                                <small class="text-muted">Gambar saat ini</small>
                            </div>
                        @endif

                        <input type="file" name="image" 
                               class="form-control-file @error('image') is-invalid @enderror" 
                               accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                        @error('image') <br><span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div class="card-footer d-flex justify-content-between align-items-center">
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('admin.promo.index') }}" class="btn btn-secondary ml-1">
                            <i class="fas fa-arrow-left"></i> Batal
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection