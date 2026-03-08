@extends('layout.main')

@section('title','Kontak')
@section('page-title','Kelola Kontak')

@section('content')
<div class="card">
<div class="card-header d-flex justify-content-between align-items-center">
<h3 class="card-title mb-0">Data Kontak</h3>
<a href="{{ route('admin.contacts.create') }}" class="btn btn-primary btn-sm">Tambah</a>
</div>

<div class="card-body p-2">

@if(session('success'))
<div class="alert alert-success mb-2">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-hover mb-0">
<thead>
<tr>
<th width="50">No</th>
<th>Email</th>
<th>No Telepon</th>
<th>Alamat</th>
<th>Jadwal</th>
<th width="150">Aksi</th>
</tr>
</thead>

<tbody>
@forelse($contacts as $contact)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $contact->email }}</td>
<td>{{ $contact->no_telepon }}</td>
<td>{{ $contact->alamat }}</td>
<td>{{ $contact->jadwal }}</td>
<td>

<a href="{{ route('admin.contacts.edit',$contact->id) }}" class="btn btn-warning btn-sm">Edit</a>

<form action="{{ route('admin.contacts.destroy',$contact->id) }}" method="POST" class="d-inline">
@csrf
@method('DELETE')
<button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
</form>

</td>
</tr>

@empty
<tr>
<td colspan="6" class="text-center">Belum ada data kontak</td>
</tr>
@endforelse
</tbody>

</table>
</div>
</div>
@endsection