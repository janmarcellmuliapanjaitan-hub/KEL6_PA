@extends('layout.main')

@section('content')
<div class="container py-4">
<div class="card">
<div class="card-header bg-warning">
<h5 class="mb-0">Edit Kontak</h5>
</div>

<div class="card-body">
<form action="{{ route('admin.contacts.update',$contact->id) }}" method="POST">
@csrf
@method('PUT')

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" value="{{ $contact->email }}" required>
</div>

<div class="mb-3">
<label>No Telepon</label>
<input type="text" name="no_telepon" class="form-control" value="{{ $contact->no_telepon }}" required>
</div>

<div class="mb-3">
<label>Alamat</label>
<textarea name="alamat" class="form-control" rows="3" required>{{ $contact->alamat }}</textarea>
</div>

<div class="mb-3">
<label>Jadwal</label>
<input type="text" name="jadwal" class="form-control" value="{{ $contact->jadwal }}" required>
</div>

<div class="d-flex justify-content-between">
<a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Batal</a>
<button class="btn btn-primary">Update</button>
</div>

</form>
</div>
</div>
</div>
@endsection