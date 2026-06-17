@extends('layouts.app')

@section('title', 'Beranda')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

{{-- HERO --}}
<section class="hero">
    <video autoplay loop muted playsinline poster="{{ asset('image/home.png') }}">
        <source src="{{ asset('image/video.mp4') }}" type="video/mp4">
    </video>
  <div class="hero-body">
    <p class="hero-eyebrow">Janji Martahan Coffee</p>
    <h1>Temukan Kenikmatan<br><em>Kopi Khas Balige</em></h1>
    <p class="hero-sub">Kopi lokal terbaik Sumatera Utara dan Suasana yang nyaman</p>
  </div>
</section>

<hr class="divider">

{{-- TENTANG --}}
<section class="s">
  <div class="pg">
    <p class="lbl">Tentang Kami</p>
    <h2 class="title">Janji Martahan <em>Coffee Balige</em></h2>

    <div class="about-grid">
      <div class="img-wrap">
        <img src="{{ asset('image/kopi.jpeg') }}" alt="Tentang Cafe">
        <div class="img-chip">
          <strong>2025</strong>
          <span>Berdiri sejak</span>
        </div>
      </div>

      <div class="about-body">
        <p>Didirikan tahun 2025, kami hadir sebagai tempat nongkrong favorit di Balige dengan konsep cozy dan pemandangan alam yang indah.</p>
        <p>Menyajikan kopi pilihan dari petani lokal Sumatera Utara dengan cita rasa khas yang memanjakan lidah.</p>
        <a href="{{ route('about') ?? '#' }}" class="btn-link">
          Baca Selengkapnya <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>
</section>

<hr class="divider">

{{-- MENU --}}
<section class="s" style="background-color: var(--sand);">
  <div class="pg">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1rem; margin-bottom: 3rem;">
      <div>
        <p class="lbl">Menu Kami</p>
        <h2 class="title">Menu <em>Istimewa</em></h2>
      </div>
      <div>
        <a href="{{ route('menu') }}" class="btn-link">Lihat Selengkapnya <i class="bi bi-arrow-right"></i></a>
      </div>
    </div>

    <div class="home-menu-grid">
      @forelse($menus as $menu)
      <div class="h-menu-card">
        @if($menu->image)
            <img src="{{ asset($menu->image) }}" class="h-menu-img" alt="{{ $menu->name }}">
        @else
            <div class="h-menu-img-empty">Tanpa Gambar</div>
        @endif
        <div class="h-menu-body">
            <h3 class="h-menu-title">{{ $menu->name }}</h3>
            <p class="h-menu-desc">{{ Str::limit($menu->description, 60) }}</p>
            <div class="h-menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
        </div>
      </div>
      @empty
        <p style="text-align: center; color: var(--muted); padding: 2rem;">Belum ada menu saat ini.</p>
      @endforelse
    </div>
  </div>
</section>

<hr class="divider">

{{-- TESTIMONI --}}
<section class="s">
  <div class="pg">
    <div class="text-center mb-5">
      <h2 class="text-uppercase font-weight-bold" style="letter-spacing: 2px; color: var(--brown); font-family: 'Poppins', sans-serif; font-size: 2.2rem; margin-bottom: 0;">TESTIMONI</h2>
      <div style="width: 50px; height: 3px; background-color: #3b82f6; margin: 15px auto;"></div>
      <p style="color: var(--muted); font-size: 1rem; font-family: 'Poppins', sans-serif;">Apa kata mereka tentang kami?</p>
    </div>

    @if($testimonis->count() > 0)
    <div id="testiCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
      <div class="carousel-inner">
        @foreach($testimonis as $index => $testi)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
          <div class="testi-slider-item text-center px-3 mx-auto" style="max-width: 800px;">
            <!-- Avatar Replacement: elegant icon badge instead of photo -->
            <div class="testi-avatar-replacement d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--brown), var(--mid)); border: 2px solid var(--gold); box-shadow: 0 4px 10px rgba(0,0,0,0.12);">
              <i class="bi bi-person-fill" style="font-size: 2.2rem; color: var(--cream);"></i>
            </div>
            
            <!-- Name & Subtitle -->
            <h4 class="testi-name mb-1" style="font-family: 'Poppins', sans-serif; font-weight: 600; color: var(--brown); font-size: 1.25rem;">{{ $testi->name }}</h4>
            <p class="testi-role mb-4" style="color: var(--muted); font-size: 0.88rem; font-family: 'Poppins', sans-serif;">Pengguna Layanan</p>
            
            <!-- Quote Text (without stars) -->
            <p class="testi-text-slider mx-auto" style="font-family: 'Playfair Display', serif; font-size: 1.15rem; font-style: italic; color: var(--mid); line-height: 1.8; max-width: 650px;">
              <span style="color: #64b5f6; font-size: 1.5rem; font-family: sans-serif; font-weight: bold; margin-right: 5px;">“</span>{{ $testi->review }}<span style="color: #64b5f6; font-size: 1.5rem; font-family: sans-serif; font-weight: bold; margin-left: 5px;">”</span>
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

    <div class="text-center mt-5">
      <a href="{{ route('testimoni') }}" class="btn-link">Tulis Ulasan & Lihat Semua <i class="bi bi-arrow-right"></i></a>
    </div>
    @else
      <div style="text-align: center; color: var(--muted); padding: 3rem;">Belum ada ulasan saat ini.</div>
    @endif
  </div>
</section>



@endsection

@push('scripts')
<script>
  window.homeConfig = {
      @if(session('waUrl'))
          waUrl: "{!! session('waUrl') !!}",
          waId: "{{ md5(session('waUrl') . uniqid()) }}"
      @else
          waUrl: null,
          waId: null
      @endif
  };
</script>
<script src="{{ asset('js/home.js') }}"></script>
@endpush
