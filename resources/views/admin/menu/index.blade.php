@extends('layout.main')
@section('title', 'Kelola Menu')

@push('styles')
<style>
    .toolbar {
        display: flex; gap: 10px; flex-wrap: wrap;
        align-items: center; margin-bottom: 18px;
    }
    .toolbar input, .toolbar select {
        padding: 8px 12px; border: 1px solid #ddd;
        border-radius: 8px; font-size: 13px; outline: none;
    }
    .toolbar input:focus, .toolbar select:focus { border-color: #c87941; }
    .btn {
        padding: 9px 16px; border-radius: 8px; border: none;
        font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none;
        display: inline-flex; align-items: center; gap: 6px;
    }
    .btn-primary { background: #3d2b1f; color: #fff; }
    .btn-primary:hover { background: #c87941; }
    .btn-sm { padding: 5px 10px; font-size: 12px; }
    .btn-edit   { background: #ebf8ff; color: #2b6cb0; }
    .btn-delete { background: #fff5f5; color: #c53030; }
    .btn-toggle-on  { background: #f0fff4; color: #276749; }
    .btn-toggle-off { background: #fffff0; color: #975a16; }

    .table-wrap { background: #fff; border-radius: 10px; overflow: hidden; border: 1px solid #e5e5e5; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #f9f9f9; padding: 10px 14px; font-size: 12px; font-weight: 600; color: #555; text-align: left; white-space: nowrap; }
    td { padding: 10px 14px; font-size: 13px; border-top: 1px solid #f0f0f0; vertical-align: middle; }
    tr:hover td { background: #fafafa; }

    .menu-img { width: 48px; height: 48px; border-radius: 8px; object-fit: cover; }
    .badge { display: inline-block; padding: 2px 8px; border-radius: 50px; font-size: 11px; font-weight: 600; }
    .badge-green { background: #f0fff4; color: #276749; }
    .badge-gray  { background: #f0f0f0; color: #666; }
    .badge-orange { background: #fffaf0; color: #c87941; }

    .aksi { display: flex; gap: 6px; flex-wrap: wrap; }
    .pagination { padding: 16px; display: flex; gap: 6px; }
    .pagination a, .pagination span {
        padding: 6px 12px; border-radius: 6px; font-size: 13px;
        border: 1px solid #ddd; text-decoration: none; color: #555;
    }
    .pagination span.active { background: #3d2b1f; color: #fff; border-color: #3d2b1f; }
</style>
@endpush

@section('content')
{{-- TOOLBAR --}}
<div class="toolbar">
    <form method="GET" action="{{ route('admin.menu.index') }}" style="display:flex;gap:10px;flex-wrap:wrap;flex:1;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / kode...">
        <select name="category_id">
            <option value="">Semua Kategori</option>
            @foreach($kategori as $kat)
            <option value="{{ $kat->id }}" {{ request('category_id') == $kat->id ? 'selected' : '' }}>
                {{ $kat->icon }} {{ $kat->name }}
            </option>
            @endforeach
        </select>
        <select name="status">
            <option value="">Semua Status</option>
            <option value="aktif"    {{ request('status') == 'aktif'    ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
        <button type="submit" class="btn btn-primary">🔍 Cari</button>
        @if(request()->hasAny(['search','category_id','status']))
        <a href="{{ route('admin.menu.index') }}" class="btn" style="background:#eee;color:#555;">✕ Reset</a>
        @endif
    </form>
    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">+ Tambah Menu</a>
</div>

{{-- TABEL --}}
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Kode</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Badge</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($menus as $menu)
            <tr>
                <td><img class="menu-img" src="{{ $menu->gambar_url }}" alt="{{ $menu->nama }}"></td>
                <td style="font-weight:600;color:#888;font-size:12px;">{{ $menu->kode }}</td>
                <td style="font-weight:600;">{{ $menu->nama }}</td>
                <td>{{ $menu->category->icon ?? '' }} {{ $menu->category->name ?? '-' }}</td>
                <td style="font-weight:700;color:#c87941;">{{ $menu->harga_format }}</td>
                <td>
                    @if($menu->badge)
                    <span class="badge badge-orange">{{ $menu->badge }}</span>
                    @else
                    <span style="color:#ccc;font-size:12px;">—</span>
                    @endif
                </td>
                <td>
                    <span class="badge {{ $menu->is_active ? 'badge-green' : 'badge-gray' }}">
                        {{ $menu->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td>
                    <div class="aksi">
                        <a href="{{ route('admin.menu.edit', $menu) }}" class="btn btn-sm btn-edit">Edit</a>

                        {{-- Toggle status --}}
                        <form method="POST" action="{{ route('admin.menu.toggle', $menu) }}" style="display:inline;">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $menu->is_active ? 'btn-toggle-on' : 'btn-toggle-off' }}">
                                {{ $menu->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>

                        {{-- Hapus --}}
                        <form method="POST" action="{{ route('admin.menu.destroy', $menu) }}" style="display:inline;"
                              onsubmit="return confirm('Hapus menu {{ $menu->nama }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-delete">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center;color:#aaa;padding:30px;">
                    Tidak ada menu ditemukan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- PAGINATION --}}
    @if($menus->hasPages())
    <div class="pagination">{{ $menus->links() }}</div>
    @endif
</div>
@endsection