
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Testimoni Pelanggan</h2>

    {{-- Form Testimoni --}}
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tulis Testimoni</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('testimoni.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ulasan" class="form-label">Ulasan</label>
                            <textarea class="form-control @error('ulasan') is-invalid @enderror" 
                                      id="ulasan" name="ulasan" rows="4" required>{{ old('ulasan') }}</textarea>
                            @error('ulasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Kirim Testimoni
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Testimoni --}}
    <div class="row">
        @forelse($testimonis as $testimoni)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title mb-0">{{ $testimoni->nama }}</h5>
                        <small class="text-muted">{{ $testimoni->tanggal }}</small>
                    </div>
                    <h6 class="card-subtitle mb-3 text-muted">{{ $testimoni->email }}</h6>
                    <p class="card-text">{{ $testimoni->ulasan }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                Belum ada testimoni.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection