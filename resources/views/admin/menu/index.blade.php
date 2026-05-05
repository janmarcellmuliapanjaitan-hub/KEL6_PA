@extends('layout.main')

@section('title','Kelola Menu')
@section('page-title','Data Menu')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Daftar Menu</h3>
                <a href="{{ route('admin.menu.create') }}" class="btn btn-light btn-sm ml-auto text-primary">
                    <i class="fas fa-plus"></i> Tambah Menu
                </a>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @php
                    $categories = ['Kopi' => 'Kopi', 'Non Kopi' => 'Non Kopi', 'Snack' => 'Snack'];
                @endphp

                <ul class="nav nav-tabs" id="menu-tabs" role="tablist">
                    @foreach($categories as $id => $name)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ Str::slug($id) }}" data-toggle="tab" href="#content-{{ Str::slug($id) }}" role="tab">{{ $name }}</a>
                    </li>
                    @endforeach
                </ul>

                <div class="tab-content mt-3">
                    @foreach($categories as $id => $name)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="content-{{ Str::slug($id) }}" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th width="50">No</th>
                                        <th width="120">Gambar</th>
                                        <th>Nama Menu</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Deskripsi</th>
                                        <th width="150">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $filteredMenus = $menus->where('category', $id); @endphp
                                    @if(count($filteredMenus) > 0)
                                        @foreach($filteredMenus as $menu)
                                        <tr>
                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                            <td class="align-middle">
                                                @if($menu->image)
                                                <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="img-thumbnail" width="100">
                                                @else
                                                <span class="text-muted">No Image</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">{{ $menu->name }}</td>
                                            <td class="align-middle"><span class="badge badge-info">{{ $menu->category }}</span></td>
                                            <td class="align-middle">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                            <td class="align-middle text-left">{{ Str::limit($menu->description, 50) }}</td>
                                            <td class="align-middle">
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
                                            <td colspan="7" class="text-center">Belum ada menu di kategori ini.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
