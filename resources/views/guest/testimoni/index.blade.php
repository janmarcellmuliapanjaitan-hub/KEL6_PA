@extends('layouts.app')

@section('title', 'Testimoni Pelanggan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/testimoni.css') }}">
@endpush

@section('content')
<div class="container py-5">

  {{-- Header --}}
  <div class="mb-5">
    <p class="section-label">Kata Mereka</p>
    <h2 class="section-title">Testimoni <em>Pelanggan</em></h2>
  </div>

  <div class="row g-5">

    {{-- Form Testimoni --}}
    <div class="col-lg-4">
      <div class="form-card">
        <div class="card-header">
          <i class="bi bi-pencil-square me-2"></i> Tulis Testimoni
        </div>
        <div class="card-body">

          @if(session('success'))
            <div class="alert alert-success py-2 px-3 mb-3" style="font-size:.85rem; border-radius:4px;">
              {{ session('success') }}
            </div>
          @endif

          <form action="{{ route('testimoni.store') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control @error('nama') is-invalid @enderror"
                     id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama kamu" required>
              @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror"
                     id="email" name="email" value="{{ old('email') }}" placeholder="email@kamu.com" required>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="ulasan" class="form-label">Ulasan</label>
              <textarea class="form-control @error('ulasan') is-invalid @enderror"
                        id="ulasan" name="ulasan" rows="4"
                        placeholder="Ceritakan pengalamanmu..." required>{{ old('ulasan') }}</textarea>
              @error('ulasan')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="btn btn-submit w-100">
              <i class="bi bi-send me-1"></i> Kirim Testimoni
            </button>
          </form>

        </div>
      </div>
    </div>

    {{-- Daftar Testimoni --}}
    <div class="col-lg-8">
      <div class="row g-3">
        @forelse($testimonis as $testimoni)
          <div class="col-md-6">
            <div class="testi-card">
              <div class="card-body">

                {{-- Header: avatar + nama + tanggal --}}
                <div class="d-flex align-items-center gap-3">
                  <div class="testi-avatar">
                    {{ strtoupper(substr($testimoni->nama, 0, 1)) }}
                  </div>
                  <div class="flex-grow-1">
                    <div class="testi-name">{{ $testimoni->nama }}</div>
                    <div class="testi-email">{{ $testimoni->email }}</div>
                  </div>
                  <div class="testi-date">{{ $testimoni->tanggal }}</div>
                </div>

                <hr class="testi-divider">

                {{-- Ulasan --}}
                <div class="testi-quote">"</div>
                <p class="testi-text">{{ $testimoni->ulasan }}</p>

              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <div class="empty-state">
              <i class="bi bi-chat-square-quote"></i>
              <p>Belum ada testimoni. Jadilah yang pertama!</p>
            </div>
          </div>
        @endforelse
      </div>
    </div>

  </div>
</div>
@endsection