@extends('layouts.app')

@section('title', 'Beranda')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

{{-- HERO --}}
<section class="hero">
  <img src="https://images.unsplash.com/photo-1559925393-8be0ec4767c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80" alt="">
  <div class="hero-body">
    <p class="hero-eyebrow">Janji Martahan Coffee</p>
    <h1>Temukan Kenikmatan<br><em>Keasrian Alam</em></h1>
    <p class="hero-sub">Kopi lokal terbaik Sumatera Utara, suasana asri, dan kehangatan yang selalu membuat kamu ingin kembali.</p>
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
          <strong>2020</strong>
          <span>Berdiri sejak</span>
        </div>
      </div>

      <div class="about-body">
        <p>Didirikan tahun 2020, kami hadir sebagai tempat nongkrong favorit di Balige dengan konsep cozy dan pemandangan alam yang indah.</p>
        <p>Menyajikan kopi pilihan dari petani lokal Sumatera Utara dengan cita rasa khas yang memanjakan lidah.</p>
        <a href="{{ route('about') ?? '#' }}" class="btn-link">
          Baca Selengkapnya <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>
</section>


@endsection

@push('scripts')
<script>
  window.addEventListener('scroll', function () {
    const nav = document.querySelector('.navbar');
    if (nav) nav.classList.toggle('scrolled', window.scrollY > 50);
  });
</script>
@endpush