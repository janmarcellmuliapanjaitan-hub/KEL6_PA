@extends('layout.main')

@section('title','Edit Promo')
@section('page-title','Edit Promo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title text-white">Form Edit Promo</h3>
            </div>

            <form action="{{ route('admin.promo.update', $promo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Judul Promo</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $promo->title) }}" required>
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $promo->description) }}</textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Berlaku Sampai (Opsional)</label>
                        <input type="date" name="valid_until" class="form-control @error('valid_until') is-invalid @enderror" value="{{ old('valid_until', $promo->valid_until ? \Carbon\Carbon::parse($promo->valid_until)->format('Y-m-d') : '') }}">
                        <small class="text-muted">Kosongkan jika promo berlaku selamanya.</small>
                        @error('valid_until') <br><span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Gambar Promo</label>
                        @if($promo->image)
                            <div class="mb-2">
                                <img src="{{ Storage::url($promo->image) }}" alt="Preview" class="img-thumbnail" width="150">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                        @error('image') <br><span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning text-white">Update</button>
                    <a href="{{ route('admin.promo.index') }}" class="btn btn-default float-right">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
