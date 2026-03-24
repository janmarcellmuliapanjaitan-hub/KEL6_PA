@extends('layout.main')

@section('title','Kelola Menu')
@section('page-title','Data Menu')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">Daftar Menu</h3>
                <a href="{{ route('admin.menu.create') }}" class="btn btn-light btn-sm ml-auto">
                    <i class="fas fa-plus"></i> Tambah Menu
                </a>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th width="100">Gambar</th>
                                <th>Nama Menu</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($menus) > 0)
                                @foreach($menus as $menu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($menu->image)
                                        <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="img-thumbnail" width="80">
                                        @else
                                        <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $menu->name }}</td>
                                    <td><span class="badge badge-info">{{ $menu->category }}</span></td>
                                    <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus menu ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada menu.</td>
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
