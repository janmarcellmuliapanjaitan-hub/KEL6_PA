@extends('layout.main')
@section('title', 'Tambah Menu')

@push('styles')
<style>
    .form-card { background: #fff; border-radius: 10px; padding: 24px; max-width: 620px; border: 1px solid #e5e5e5; }
    .form-group { margin-bottom: 18px; }
    label { display: block; font-size: 12px; font-weight: 600; color: #555; margin-bottom: 7px; }
    input[type=text], input[type=number], textarea, select {
        width: 100%; padding: 10px 13px;
        border: 1.5px solid #ddd; border-radius: 8px;
        font-size: 14px; font-family: sans-serif; outline: none;
    }
    input:focus, textarea:focus, select:focus { border-color: #c87941; }
    .error-msg { font-size: 11px; color: #e53e3e; margin-top: 4px; }
    .hint { font-size: 11px; color: #aaa; margin-top: 4px; }
    .row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .form-actions { display: flex; gap: 10px; margin-top: 24px; }
    .btn { padding: 10px 20px; border-radius: 8px; border: none; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; }
    .btn-primary { background: #3d2b1f; color: #fff; }
    .btn-primary:hover { background: #c87941; }
    .btn-cancel { background: #eee; color: #555; }
    .switch-row { display: flex; align-items: center; gap: 10px; }
    input[type=checkbox] { width: 18px; height: 18px; cursor: pointer; }
    .preview-img { margin-top: 10px; max-width: 180px; border-radius: 8px; display: none; }
</style>
@endpush

@section('content')
<div class="form-card">
    <form method="POST" action="{{ route('admin.menu.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Kategori *</label>
            <select name="category_id">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $kat)
                <option value="{{ $kat->id }}" {{ old('category_id') == $kat->id ? 'selected' : '' }}>
                    {{ $kat->icon }} {{ $kat->name }}
                </option>
                @endforeach
            </select>
            @error('category_id') <div class="error-msg">{{ $message }}</div> @enderror
        </div>

        <div class="row-2">
            <div class="form-group">
                <label>Kode Menu *</label>
                <input type="text" name="kode" value="{{ old('kode') }}" placeholder="C001" maxlength="10">
                <div class="hint">Contoh: C001, F001, N001</div>
                @error('kode') <div class="error-msg">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Urutan Tampil</label>
                <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0">
                <div class="hint">Angka kecil tampil lebih dulu</div>
            </div>
        </div>

        <div class="form-group">
            <label>Nama Menu *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Cappuccino">
            @error('nama') <div class="error-msg">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat tentang menu...">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <div class="error-msg">{{ $message }}</div> @enderror
        </div>

        <div class="row-2">
            <div class="form-group">
                <label>Harga (Rp) *</label>
                <input type="number" name="harga" value="{{ old('harga') }}" placeholder="25000" min="0">
                @error('harga') <div class="error-msg">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Badge <span style="font-weight:400;color:#aaa;">(opsional)</span></label>
                <input type="text" name="badge" value="{{ old('badge') }}" placeholder="Best Seller, New, Populer..." maxlength="30">
            </div>
        </div>

        <div class="form-group">
            <label>Foto Menu <span style="font-weight:400;color:#aaa;">(opsional, maks 2MB)</span></label>
            <input type="file" name="gambar" accept="image/*" onchange="previewGambar(this)">
            <img id="previewImg" class="preview-img">
            @error('gambar') <div class="error-msg">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <div class="switch-row">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    {{ old('is_active', true) ? 'checked' : '' }}>
                <label for="is_active" style="margin:0;font-weight:500;cursor:pointer;">Tampilkan menu (aktif)</label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">💾 Simpan Menu</button>
            <a href="{{ route('admin.menu.index') }}" class="btn btn-cancel">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewGambar(input) {
    const img = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; img.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush