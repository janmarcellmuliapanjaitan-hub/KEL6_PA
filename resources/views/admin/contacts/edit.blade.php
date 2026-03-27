@extends('layout.main')

@section('title','Edit Kontak')
@section('page-title','Edit Kontak')

@section('content')
<div class="row justify-content-start">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-edit mr-2"></i> Form Edit Kontak
                </h3>
            </div>

            <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label><i class="fas fa-envelope mr-1 text-primary"></i> Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $contact->email }}" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-phone mr-1 text-primary"></i> No Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" value="{{ $contact->no_telepon }}" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-map-marker-alt mr-1 text-primary"></i> Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required>{{ $contact->alamat }}</textarea>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-calendar-alt mr-1 text-primary"></i> Jadwal</label>
                        <input type="text" name="jadwal" class="form-control" value="{{ $contact->jadwal }}" required>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between align-items-center">
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary ml-1">
                            <i class="fas fa-arrow-left"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection