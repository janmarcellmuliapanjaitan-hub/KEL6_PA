@extends('layouts.admin')

@section('title', 'About Us')
@section('page-title', 'Kelola About Us')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Data About Us</h6>
                @if(!$about)
                    <a href="{{ route('admin.about.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus"></i> Tambah Data
                    </a>
                @endif
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($about)
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            @if($about->gambar)
                                <img src="{{ asset('uploads/about/'.$about->gambar) }}" class="img-fluid rounded">
                            @else
                                <div class="bg-light p-5 text-center rounded">
                                    <i class="bi bi-image fs-1"></i>
                                    <p>Tidak ada gambar</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="150">Judul</th>
                                    <td>{{ $about->judul }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>
                                        <pre style="max-height: 300px; overflow: auto;">{{ $about->deskripsi }}</pre>
                                    </td>
                                </tr>
                            </table>
                            <a href="{{ route('admin.about.edit', $about->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('admin.about.destroy', $about->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Yakin hapus data?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-info-circle fs-1"></i>
                        <p class="mt-3">Belum ada data about us. Silakan tambah data.</p>
                        <a href="{{ route('admin.about.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection