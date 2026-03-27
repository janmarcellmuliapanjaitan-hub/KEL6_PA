@extends('layout.main')

@section('title','Edit Menu')
@section('page-title','Edit Menu')

@section('content')
<div class="row justify-content-start">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-edit mr-2"></i> Form Edit Menu
                </h3>
            </div>

            <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">

                    <div class="form-group">
                        <label><i class="fas fa-heading mr-1 text-primary"></i> Nama Menu</label>
                        <input type="text" name="name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name', $menu->name) }}" 
                               placeholder="Masukkan nama menu"
                               required>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-tags mr-1 text-primary"></i> Kategori</label>
                        <select name="category" class="form-control @error('category') is-invalid @enderror" required>
                            <option value="Kopi" {{ old('category', $menu->category) == 'Kopi' ? 'selected' : '' }}>Kopi</option>
                            <option value="Non Kopi" {{ old('category', $menu->category) == 'Non Kopi' ? 'selected' : '' }}>Non Kopi</option>
                            <option value="Snack" {{ old('category', $menu->category) == 'Snack' ? 'selected' : '' }}>Snack</option>
                        </select>
                        @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-money-bill-wave mr-1 text-primary"></i> Harga (Rp)</label>
                        <input type="number" name="price" 
                               class="form-control @error('price') is-invalid @enderror" 
                               value="{{ old('price', $menu->price) }}" 
                               placeholder="Contoh: 15000"
                               required>
                        @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-align-left mr-1 text-primary"></i> Deskripsi</label>
                        <textarea name="description" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  rows="4" 
                                  placeholder="Masukkan deskripsi menu">{{ old('description', $menu->description) }}</textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-image mr-1 text-primary"></i> Gambar Menu</label>

                        @if($menu->image)
                            <div class="mb-2">
                                <img src="{{ asset($menu->image) }}" 
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
                        <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary ml-1">
                            <i class="fas fa-arrow-left"></i> Batal
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
