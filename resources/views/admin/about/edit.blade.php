@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Edit About Us</h3>
    
    <form action="{{ url('admin/about/'.$about->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" value="{{ $about->judul }}" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Tahun Berdiri</label>
                    <input type="text" name="tahun_berdiri" value="{{ $about->tahun_berdiri }}" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" value="{{ $about->lokasi }}" class="form-control">
                </div>
            </div>
        </div>

        @if($about->gambar)
        <div class="mb-3">
            <label>Gambar Saat Ini</label><br>
            <img src="{{ asset('uploads/about/'.$about->gambar) }}" width="150">
        </div>
        @endif

        <div class="mb-3">
            <label>Gambar Baru</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <div class="mb-3">
            <label>Sejarah</label>
            <textarea name="sejarah" rows="4" class="form-control" required>{{ $about->sejarah }}</textarea>
        </div>

        <div class="mb-3">
            <label>Visi</label>
            <textarea name="visi" rows="3" class="form-control">{{ $about->visi }}</textarea>
        </div>

        <div class="mb-3">
            <label>How to Order</label>
            <textarea name="how_to_order" rows="6" class="form-control" required>{{ $about->how_to_order }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url('admin/about') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection