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
    <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1rem; margin-bottom: 3rem;">
      <div>
        <p class="lbl">Ulasan Pelanggan</p>
        <h2 class="title">Apa Kata <em>Mereka</em></h2>
      </div>
      <div>
        <a href="{{ route('testimoni') }}" class="btn-link">Lihat Selengkapnya <i class="bi bi-arrow-right"></i></a>
      </div>
    </div>

    <div class="testi-grid" style="margin-top: 0;">
      @forelse($testimonis as $testi)
      <div class="testi-card">
        <div class="testi-top">
          <!-- Placeholder avatar -->
          <div style="width:42px; height:42px; border-radius:50%; background:var(--gold); display:flex; align-items:center; justify-content:center; color:var(--cream); font-weight:bold; font-size:1.2rem;">
              {{ strtoupper(substr($testi->nama, 0, 1)) }}
          </div>
          <div>
            <div class="testi-name">{{ $testi->nama }}</div>
            <div class="testi-role">{{ $testi->tanggal }}</div>
          </div>
        </div>
        <p class="testi-text">"{{ $testi->ulasan }}"</p>
      </div>
      @empty
        <div style="grid-column: 1 / -1; text-align: center; color: var(--muted); padding: 2rem;">Belum ada ulasan saat ini.</div>
      @endforelse
    </div>
  </div>
</section>



@endsection

@push('scripts')
<script>
  @if(session('waUrl'))
      // Gunakan ID unik untuk mencegah loop redirect saat user menekan tombol Back (BFCache)
      var waId = "{{ md5(session('waUrl') . uniqid()) }}";
      if (sessionStorage.getItem('wa_redirect_id') !== waId) {
          sessionStorage.setItem('wa_redirect_id', waId);
          window.location.href = "{!! session('waUrl') !!}";
      }
  @endif

  // Navbar scroll effect (existing)
  window.addEventListener('scroll', function () {
    const nav = document.querySelector('.navbar');
    if (nav) nav.classList.toggle('scrolled', window.scrollY > 50);
  });

  // ========== SCROLL REVEAL ANIMATION ==========
  // Add reveal classes to elements you want to animate on scroll
  document.addEventListener('DOMContentLoaded', function() {
    // Add reveal classes to sections
    const sections = document.querySelectorAll('.s');
    sections.forEach((section, index) => {
      // Add different reveal classes based on section index
      if (index === 0) {
        section.classList.add('reveal-fade-up');
      } else if (index === 1) {
        section.classList.add('reveal-fade-left');
      } else if (index === 2) {
        section.classList.add('reveal-fade-right');
      } else {
        section.classList.add('reveal-scale');
      }
    });

    // Add reveal to hero body if needed
    const heroBody = document.querySelector('.hero-body');
    if (heroBody && !heroBody.classList.contains('reveal-fade-up')) {
      heroBody.classList.add('reveal-fade-up');
    }

    // Create Intersection Observer
    const observerOptions = {
      threshold: 0.15,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('revealed');
          // Optional: unobserve after animation
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    // Observe all elements with reveal classes
    const revealElements = document.querySelectorAll('[class*="reveal-"]');
    revealElements.forEach(el => observer.observe(el));

    // Also observe menu cards individually for smoother animation
    const menuCards = document.querySelectorAll('.h-menu-card');
    menuCards.forEach(card => {
      if (!card.classList.contains('reveal-scale')) {
        card.style.opacity = '0';
        card.style.animation = 'none';
        observer.observe(card);
      }
    });

    // Add animation to menu cards when observed
    const menuObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry, idx) => {
        if (entry.isIntersecting) {
          const card = entry.target;
          const delay = (Array.from(menuCards).indexOf(card) * 0.08);
          card.style.animation = `scaleIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) ${delay}s forwards`;
          menuObserver.unobserve(card);
        }
      });
    }, { threshold: 0.1 });

    menuCards.forEach(card => menuObserver.observe(card));
  });

  // Parallax effect for hero background (optional)
  window.addEventListener('scroll', function() {
    const heroBg = document.querySelector('.hero img, .hero video');
    if (heroBg) {
      const scrolled = window.pageYOffset;
      heroBg.style.transform = `translateY(${scrolled * 0.5}px) scale(1.05)`;
    }
  });
</script>
@endpush
