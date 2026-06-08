@extends('layouts.app')

@section('title', 'Testimoni Pelanggan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/testimoni.css') }}">
@endpush

@section('content')
<div class="container py-5">

  {{-- Header --}}
  <div class="text-center mb-5">
    <h2 class="section-title">Testimoni <em>Pelanggan</em></h2>
  </div>

  @if(session('success'))
    <div class="alert alert-success py-2 px-3 mb-4 mx-auto text-center" style="font-size:.85rem; border-radius:4px; max-width: 600px;">
      {{ session('success') }}
    </div>
  @endif

  <div class="row justify-content-center">
    <div class="col-lg-8">
      {{-- Carousel Slider (Centered) --}}
      <div class="w-100 p-5 rounded d-flex align-items-center justify-content-center mb-4" style="background-color: var(--cream); border: 1px solid var(--line); box-shadow: 0 4px 15px rgba(0,0,0,0.02); min-height: 350px;">
        @if($testimonis->count() > 0)
        <div id="testiCarousel" class="carousel slide w-100" data-bs-ride="carousel" data-bs-interval="5000">
          <div class="carousel-inner">
            @foreach($testimonis as $index => $testi)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
              <div class="testi-slider-item text-center px-3 mx-auto" style="max-width: 600px;">
                <!-- Avatar Replacement: elegant icon badge -->
                <div class="testi-avatar-replacement d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--brown), var(--mid)); border: 2px solid var(--gold); box-shadow: 0 4px 10px rgba(0,0,0,0.12);">
                  <i class="bi bi-person-fill" style="font-size: 2.2rem; color: var(--cream);"></i>
                </div>
                
                <!-- Name & Subtitle -->
                <h4 class="testi-name mb-1" style="font-family: 'Poppins', sans-serif; font-weight: 600; color: var(--brown); font-size: 1.25rem;">{{ $testi->nama }}</h4>
                <p class="testi-role mb-2" style="color: var(--muted); font-size: 0.88rem; font-family: 'Poppins', sans-serif;">Pengguna Layanan</p>
                <div style="color: var(--muted); font-size: 0.72rem; margin-bottom: 1.25rem;">{{ $testi->tanggal }}</div>
                
                <!-- Quote Text -->
                <p class="testi-text-slider mx-auto" style="font-family: 'Playfair Display', serif; font-size: 1.1rem; font-style: italic; color: var(--mid); line-height: 1.7; max-width: 500px;">
                  <span style="color: #64b5f6; font-size: 1.5rem; font-family: sans-serif; font-weight: bold; margin-right: 5px;">“</span>{{ $testi->ulasan }}<span style="color: #64b5f6; font-size: 1.5rem; font-family: sans-serif; font-weight: bold; margin-left: 5px;">”</span>
                </p>
              </div>
            </div>
            @endforeach
          </div>

          <!-- Carousel Indicators (Dots) -->
          <div class="carousel-indicators position-relative mt-4 mb-0">
            @foreach($testimonis as $index => $testi)
            <button type="button" data-bs-target="#testiCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
          </div>
        </div>
        @else
          <div class="empty-state w-100">
            <i class="bi bi-chat-square-quote"></i>
            <p>Belum ada testimoni. Jadilah yang pertama!</p>
          </div>
        @endif
      </div>

      {{-- Tambah Testimoni Button --}}
      <div class="text-center">
        <button type="button" class="btn btn-submit px-4 py-2" data-bs-toggle="modal" data-bs-target="#tambahTestimoniModal" style="border-radius: 30px; font-family: 'Poppins', sans-serif;">
          <i class="bi bi-plus-circle me-2"></i> Tambah Testimoni
        </button>
      </div>
    </div>
  </div>

</div>

<!-- Modal Tambah Testimoni -->
<div class="modal fade" id="tambahTestimoniModal" tabindex="-1" aria-labelledby="tambahTestimoniModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: var(--cream); border: 1px solid var(--line); border-radius: 12px; box-shadow: 0 10px 30px rgba(43,26,14,0.15);">
      <div class="modal-header" style="border-bottom: 1px solid var(--line);">
        <h5 class="modal-title" id="tambahTestimoniModalLabel" style="font-family: 'Poppins', sans-serif; font-weight: 600; color: var(--brown);">
          <i class="bi bi-pencil-square me-2" style="color: var(--gold);"></i> Tulis Testimoni
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        @auth
        <form action="{{ route('testimoni.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label for="nama" class="form-label" style="color: var(--muted); font-weight: 500; font-family: 'Poppins', sans-serif; font-size: 0.9rem;">Nama Lengkap</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                   style="border: 1px solid var(--line); background-color: #fff; color: var(--brown); font-family: 'Poppins', sans-serif;"
                   id="nama" name="nama" value="{{ old('nama', auth()->user()->name) }}" placeholder="Nama kamu" required readonly>
            @error('nama')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="form-label" style="color: var(--muted); font-weight: 500; font-family: 'Poppins', sans-serif; font-size: 0.9rem;">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   style="border: 1px solid var(--line); background-color: #fff; color: var(--brown); font-family: 'Poppins', sans-serif;"
                   id="email" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="email@kamu.com" required readonly>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="ulasan" class="form-label" style="color: var(--muted); font-weight: 500; font-family: 'Poppins', sans-serif; font-size: 0.9rem;">Ulasan</label>
            <textarea class="form-control @error('ulasan') is-invalid @enderror"
                      style="border: 1px solid var(--line); background-color: #fff; color: var(--brown); font-family: 'Poppins', sans-serif;"
                      id="ulasan" name="ulasan" rows="4"
                      placeholder="Ceritakan pengalamanmu..." required>{{ old('ulasan') }}</textarea>
            @error('ulasan')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <button type="submit" class="btn btn-submit w-100" style="background: var(--gold); color: #fff; font-weight: 600; border-radius: 30px; font-family: 'Poppins', sans-serif; padding: 10px;">
            <i class="bi bi-send me-1"></i> Kirim Testimoni
          </button>
        </form>
        @else
        <div class="text-center py-3">
          <div class="mb-3">
            <i class="bi bi-lock-fill" style="font-size: 3rem; color: var(--gold);"></i>
          </div>
          <h5 class="mb-3" style="color: var(--brown); font-family: 'Poppins', sans-serif; font-weight: 600;">Login Diperlukan</h5>
          <p class="text-muted mb-4" style="font-size: 0.9rem; font-family: 'Poppins', sans-serif;">
            Silakan login sebagai pelanggan terlebih dahulu untuk dapat membagikan pengalaman Anda.
          </p>
          <a href="{{ route('guest.login.form') }}" class="btn btn-submit w-100 mb-2" style="background: var(--gold); color: #fff; font-weight: 600; border-radius: 30px; padding: 10px;">
            <i class="bi bi-box-arrow-in-right me-1"></i> Login Pelanggan
          </a>
          <p class="mb-0 text-muted" style="font-size: 0.85rem; font-family: 'Poppins', sans-serif;">
            Belum punya akun? <a href="{{ route('guest.register.form') }}" style="color: var(--gold); font-weight: 500;">Daftar di sini</a>
          </p>
        </div>
        @endauth
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var myCarousel = document.querySelector('#testiCarousel');
    if (myCarousel) {
      new bootstrap.Carousel(myCarousel, {
        interval: 3500,
        ride: 'carousel',
        wrap: true
      });
    }
  });
</script>
@endpush