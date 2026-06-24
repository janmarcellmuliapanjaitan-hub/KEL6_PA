@extends('layout.main')

@section('title', 'Pengaturan Sistem')
@section('page-title', 'Pengaturan Sistem')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-cogs mr-2"></i> Konfigurasi Janji Martahan Coffee</h3>
            </div>

            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="admin_whatsapp">Nomor WhatsApp Admin</label>
                        <input type="text" class="form-control" id="admin_whatsapp" name="admin_whatsapp" value="{{ old('admin_whatsapp', $adminWa) }}" placeholder="Contoh: 628123456789">
                        <small class="form-text text-muted">
                            Masukkan nomor WhatsApp lengkap menggunakan kode negara tanpa tanda "+" (misalnya <strong>628123456789</strong>). Nomor ini digunakan untuk menerima pemesanan baru dari pelanggan.
                        </small>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save mr-1"></i> Simpan Pengaturan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
