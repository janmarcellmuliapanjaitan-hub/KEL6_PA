@extends('layout.main')

@section('title','Edit Menu')
@section('page-title','Edit Menu')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Edit Menu</h3>
            </div>

            <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Menu</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $menu->name) }}" required>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category" class="form-control @error('category') is-invalid @enderror" required>
                            <option value="Kopi" {{ old('category', $menu->category) == 'Kopi' ? 'selected' : '' }}>Kopi</option>
                            <option value="Non Kopi" {{ old('category', $menu->category) == 'Non Kopi' ? 'selected' : '' }}>Non Kopi</option>
                            <option value="Snack" {{ old('category', $menu->category) == 'Snack' ? 'selected' : '' }}>Snack</option>
                        </select>
                        @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Harga (Rp)</label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $menu->price) }}" required>
                        @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $menu->description) }}</textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Gambar Menu Saat Ini</label><br>
                        @if($menu->image)
                            <img src="{{ asset($menu->image) }}" class="img-thumbnail mb-2" width="150"><br>
                        @else
                            <span class="text-muted">Tidak ada gambar</span><br>
                        @endif
                        <label>Ubah Gambar (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*">
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-default float-right">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
