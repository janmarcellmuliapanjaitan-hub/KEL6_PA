@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>About Us</h3>
        @if(!$about)
            <a href="{{ url('admin/about/create') }}" class="btn btn-primary">Tambah</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($about)
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($about->gambar)
                            <img src="{{ asset('uploads/about/'.$about->gambar) }}" class="img-fluid">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr><th>Judul</th><td>{{ $about->judul }}</td></tr>
                            <tr><th>Tahun</th><td>{{ $about->tahun_berdiri ?? '-' }}</td></tr>
                            <tr><th>Lokasi</th><td>{{ $about->lokasi ?? '-' }}</td></tr>
                            <tr><th>Sejarah</th><td>{{ $about->sejarah }}</td></tr>
                            <tr><th>Visi</th><td>{{ $about->visi ?? '-' }}</td></tr>
                            <tr><th>How to Order</th><td>{!! nl2br(e($about->how_to_order)) !!}</td></tr>
                        </table>
                        <a href="{{ url('admin/about/'.$about->id.'/edit') }}" class="btn btn-warning">Edit</a>
                        <form action="{{ url('admin/about/'.$about->id) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">Belum ada data</div>
    @endif
</div>
@endsection