@extends('layout.main')
@section('title', 'Kelola Kategori')

@push('styles')
<style>
    .layout-2col { display: grid; grid-template-columns: 1fr 340px; gap: 20px; align-items: start; }
    .card { background: #fff; border-radius: 10px; padding: 20px; border: 1px solid #e5e5e5; }
    .card h3 { font-size: 15px; margin-bottom: 16px; padding-bottom: 10px; border-bottom: 1px solid #eee; }

    table { width: 100%; border-collapse: collapse; }
    th { background: #f9f9f9; padding: 10px 14px; font-size: 12px; font-weight: 600; color: #555; text-align: left; }
    td { padding: 10px 14px; font-size: 13px; border-top: 1px solid #f0f0f0; vertical-align: middle; }

    .badge { display: inline-block; padding: 2px 8px; border-radius: 50px; font-size: 11px; font-weight: 600; }
    .badge-green { background: #f0fff4; color: #276749; }
    .badge-gray  { background: #f0f0f0; color: #666; }

    .aksi { display: flex; gap: 6px; }
    .btn { padding: 6px 12px; border-radius: 6px; border: none; font-size: 12px; font-weight: 600; cursor: pointer; text-decoration: none; }
    .btn-edit   { background: #ebf8ff; color: #2b6cb0; }
    .btn-delete { background: #fff5f5; color: #c53030; }
    .btn-primary { background: #3d2b1f; color: #fff; padding: 10px 16px; font-size: 14px; }
    .btn-primary:hover { background: #c87941; }

    .form-group { margin-bottom: 14px; }
    label { display: block; font-size: 12px; font-weight: 600; color: #555; margin-bottom: 6px; }
    input[type=text], input[type=number] {
        width: 100%; padding: 9px 12px;
        border: 1.5px solid #ddd; border-radius: 8px;
        font-size: 13px; outline: none;
    }
    input:focus { border-color: #c87941; }
    .error-msg { font-size: 11px; color: #e53e3e; margin-top: 4px; }
    .hint { font-size: 11px; color: #aaa; margin-top: 3px; }
    .switch-row { display: flex; align-items: center; gap: 8px; }
    input[type=checkbox] { width: 16px; height: 16px; }

    /* Modal edit kategori */
    .modal-backdrop { display:none; position:fixed; inset:0; background:rgba(0,0,0,.4); z-index:100; align-items:center; justify-content:center; }
    .modal-backdrop.show { display:flex; }
    .modal-box { background:#fff; border-radius:12px; padding:24px; width:100%; max-width:360px; }
    .modal-box h3 { font-size:15px; margin-bottom:16px; }
    .modal-actions { display:flex; gap:10px; margin-top:16px; }
    .btn-cancel { background:#eee; color:#555; padding:9px 16px; }
</style>
@endpush

@section('content')
<div class="layout-2col">

    {{-- TABEL KATEGORI --}}
    <div class="card">
        <h3>📂 Daftar Kategori</h3>
        <table>
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Nama</th>
                    <th>Urutan</th>
                    <th>Jumlah Menu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $kat)
                <tr>
                    <td style="font-size:20px;">{{ $kat->icon }}</td>
                    <td style="font-weight:600;">{{ $kat->name }}</td>
                    <td>{{ $kat->urutan }}</td>
                    <td>{{ $kat->semua_menu_count }} menu</td>
                    <td>
                        <span class="badge {{ $kat->is_active ? 'badge-green' : 'badge-gray' }}">
                            {{ $kat->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <div class="aksi">
                            <button class="btn btn-edit"
                                onclick="bukaEdit({{ $kat->id }}, '{{ $kat->name }}', '{{ $kat->icon }}', {{ $kat->urutan }}, {{ $kat->is_active ? 1 : 0 }})">
                                Edit
                            </button>
                            <form method="POST" action="{{ route('admin.kategori.destroy', $kat) }}"
                                  onsubmit="return confirm('Hapus kategori {{ $kat->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-delete">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:#aaa;padding:20px;">Belum ada kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- FORM TAMBAH KATEGORI --}}
    <div class="card">
        <h3>➕ Tambah Kategori</h3>
        <form method="POST" action="{{ route('admin.kategori.store') }}">
            @csrf
            <div class="form-group">
                <label>Nama Kategori *</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Coffee">
                @error('name') <div class="error-msg">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Icon Emoji</label>
                <input type="text" name="icon" value="{{ old('icon') }}" placeholder="☕" maxlength="10">
                <div class="hint">Copy-paste emoji dari keyboard atau situs emojipedia</div>
            </div>
            <div class="form-group">
                <label>Urutan Tampil</label>
                <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0">
            </div>
            <div class="form-group">
                <div class="switch-row">
                    <input type="checkbox" name="is_active" id="is_active_new" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label for="is_active_new" style="margin:0;font-weight:400;cursor:pointer;">Aktif</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;">💾 Simpan Kategori</button>
        </form>
    </div>
</div>

{{-- MODAL EDIT KATEGORI --}}
<div class="modal-backdrop" id="editModal" onclick="tutupEdit(event)">
    <div class="modal-box">
        <h3>✏️ Edit Kategori</h3>
        <form method="POST" id="editForm">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Nama Kategori *</label>
                <input type="text" name="name" id="editName">
            </div>
            <div class="form-group">
                <label>Icon Emoji</label>
                <input type="text" name="icon" id="editIcon" maxlength="10">
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="urutan" id="editUrutan" min="0">
            </div>
            <div class="form-group">
                <div class="switch-row">
                    <input type="checkbox" name="is_active" id="editActive" value="1">
                    <label for="editActive" style="margin:0;font-weight:400;cursor:pointer;">Aktif</label>
                </div>
            </div>
            <div class="modal-actions">
                <button type="submit" class="btn btn-primary">💾 Update</button>
                <button type="button" class="btn btn-cancel" onclick="tutupEditBtn()">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function bukaEdit(id, name, icon, urutan, isActive) {
    document.getElementById('editName').value    = name;
    document.getElementById('editIcon').value    = icon;
    document.getElementById('editUrutan').value  = urutan;
    document.getElementById('editActive').checked = isActive == 1;
    document.getElementById('editForm').action   = `/admin/kategori/${id}`;
    document.getElementById('editModal').classList.add('show');
}
function tutupEdit(e) {
    if (e.target === document.getElementById('editModal')) tutupEditBtn();
}
function tutupEditBtn() {
    document.getElementById('editModal').classList.remove('show');
}
</script>
@endpush