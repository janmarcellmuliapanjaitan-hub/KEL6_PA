@extends('layout.main')

@section('title','Tambah Kontak')
@section('page-title','Tambah Kontak Baru')

@section('content')
<div class="row justify-content-start">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Kontak</h3>
            </div>

            <form action="{{ route('admin.contacts.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Jadwal</label>
                        <input type="text" name="jadwal" class="form-control" placeholder="Contoh: Senin - Jumat: 08.00 - 20.00" required>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary ml-1">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection