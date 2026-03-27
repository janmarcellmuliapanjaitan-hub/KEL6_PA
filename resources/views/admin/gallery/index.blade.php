@extends('layout.main')

@section('title', 'Manajemen Galeri')
@section('page-title', 'Manajemen Galeri')

@section('content')
<div class="stat-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="mb-0">Daftar Galeri</h6>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i>Tambah Foto
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-sadmin table-hover">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">File (Preview)</th>
                    <th width="50%">Deskripsi</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($galleries as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $item->file_path) }}" alt="Photo" class="img-thumbnail" style="max-height: 80px; width: auto;">
                    </td>
                    <td>{{ Str::limit($item->description, 50) }}</td>
                    <td>
                        <a href="{{ route('admin.gallery.edit', $item->id) }}" class="btn btn-warning btn-sm btn-action text-white">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm btn-action">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Belum ada foto galeri.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
