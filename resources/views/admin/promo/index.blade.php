@extends('layout.main')

@section('title','Kelola Promo')
@section('page-title','Data Promo')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Daftar Promo</h3>
                <a href="{{ route('admin.promo.create') }}" class="btn btn-light btn-sm ml-auto text-primary">
                    <i class="fas fa-plus"></i> Tambah Promo
                </a>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th width="120">Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Berlaku Sampai</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($promos) > 0)
                                @foreach($promos as $promo)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">
                                        @if($promo->image)
                                        <img src="{{ Storage::url($promo->image) }}" alt="{{ $promo->title }}" class="img-thumbnail" width="100">
                                        @else
                                        <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $promo->title }}</td>
                                    <td class="align-middle text-left">{{ Str::limit($promo->description, 50) }}</td>
                                    <td class="align-middle">
                                        @if($promo->valid_until)
                                            <span class="badge badge-{{ \Carbon\Carbon::parse($promo->valid_until)->isPast() ? 'danger' : 'success' }}">
                                                {{ \Carbon\Carbon::parse($promo->valid_until)->translatedFormat('d F Y') }}
                                            </span>
                                        @else
                                            <span class="badge badge-info">Selamanya</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('admin.promo.edit', $promo->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.promo.destroy', $promo->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus promo ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada promo.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
