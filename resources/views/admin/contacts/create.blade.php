@extends('layout.main')

@section('content')
<div class="container py-4">
<div class="card">
<div class="card-header bg-primary text-white">
<h5 class="mb-0">Tambah Kontak</h5>
</div>

<div class="card-body">
<form action="{{ route('admin.contacts.store') }}" method="POST">
@csrf

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>No Telepon</label>
<input type="text" name="no_telepon" class="form-control" required>
</div>

<div class="mb-3">
<label>Alamat</label>
<textarea name="alamat" class="form-control" rows="3" required></textarea>
</div>

<div class="mb-3">
<label>Jadwal</label>
<input type="text" name="jadwal" class="form-control" placeholder="Senin - Jumat: 08.00 - 20.00" required>
</div>

<div class="d-flex justify-content-between">
<a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Batal</a>
<button class="btn btn-primary">Simpan</button>
</div>

</form>
</div>
</div>
</div>
@endsection