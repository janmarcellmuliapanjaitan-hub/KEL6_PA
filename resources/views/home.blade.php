@extends('layouts.app')

@section('title', 'Beranda')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --cream : #f9f5f0;
    --sand  : #ece5d8;
    --brown : #2b1a0e;
    --mid   : #6b4a28;
    --gold  : #c07930;
    --muted : #9a8270;
    --line  : rgba(43,26,14,.10);
  }
  body { background:var(--cream); color:var(--brown); font-family:'Inter',sans-serif; font-weight:300; }

  /* ─ layout helpers ─ */
  .pg { max-width:1080px; margin:0 auto; padding:0 2rem; }
  .divider { border:none; border-top:1px solid var(--line); margin:0; }

  /* ─ section spacing ─ */
  .s { padding:5rem 0; }

  /* ─ label / heading ─ */
  .lbl {
    display:inline-flex; align-items:center; gap:8px;
    font-size:.65rem; letter-spacing:.25em; text-transform:uppercase;
    color:var(--gold); font-weight:500; margin-bottom:.75rem;
  }
  .lbl::before { content:''; width:18px; height:1px; background:var(--gold); }

  h2.title {
    font-family:'Playfair Display',serif;
    font-size:clamp(1.8rem,3.5vw,2.6rem);
    font-weight:400; line-height:1.2; color:var(--brown);
  }
  h2.title em { font-style:italic; color:var(--gold); }

  /* ─ HERO ─ */
  .hero {
    position:relative; min-height:88vh;
    display:flex; align-items:center;
    background:#1a0f06;
    overflow:hidden;
  }
  .hero img {
    position:absolute; inset:0; width:100%; height:100%;
    object-fit:cover; opacity:.30;
  }
  .hero-body { position:relative; z-index:1; padding:5rem 2rem; max-width:1080px; margin:0 auto; }

  .hero-eyebrow {
    font-size:.65rem; letter-spacing:.28em; text-transform:uppercase;
    color:var(--gold); display:flex; align-items:center; gap:8px; margin-bottom:1.25rem;
  }
  .hero-eyebrow::before { content:''; width:18px; height:1px; background:var(--gold); }

  .hero h1 {
    font-family:'Playfair Display',serif;
    font-size:clamp(3rem,6.5vw,5.5rem);
    font-weight:400; line-height:1.08;
    color:#f9f5f0; letter-spacing:-.02em;
  }
  .hero h1 em { font-style:italic; color:#e8c47a; }

  .hero-sub {
    margin-top:1.5rem; font-size:.9rem; line-height:1.8;
    color:rgba(249,245,240,.50); max-width:400px;
  }

  /* ─ ABOUT ─ */
  .about-grid {
    display:grid; grid-template-columns:1fr 1fr;
    gap:4rem; align-items:center; margin-top:3rem;
  }
  .img-wrap { position:relative; }
  .img-wrap img {
    width:100%; aspect-ratio:4/3; object-fit:cover;
    border-radius:3px; display:block;
    filter:saturate(.85);
    transition:filter .4s;
  }
  .img-wrap:hover img { filter:saturate(1); }
  .img-chip {
    position:absolute; bottom:-1rem; right:-1rem;
    background:var(--brown); color:var(--cream);
    padding:.85rem 1.25rem; border-radius:3px; line-height:1;
  }
  .img-chip strong { display:block; font-family:'Playfair Display',serif; font-size:1.7rem; font-weight:400; }
  .img-chip span { font-size:.58rem; letter-spacing:.12em; text-transform:uppercase; opacity:.55; }

  .about-body p { font-size:.9rem; line-height:1.85; color:var(--muted); margin-bottom:.9rem; }
  .about-body p:first-of-type {
    font-family:'Playfair Display',serif; font-style:italic;
    font-size:1rem; color:var(--mid); border-left:2px solid var(--gold);
    padding-left:1rem; margin-bottom:1.25rem;
  }

  .btn-link {
    display:inline-flex; align-items:center; gap:7px; margin-top:.5rem;
    font-size:.78rem; letter-spacing:.1em; text-transform:uppercase; font-weight:500;
    color:var(--brown); text-decoration:none; border-bottom:1px solid var(--brown);
    padding-bottom:2px; transition:color .2s,border-color .2s;
  }
  .btn-link:hover { color:var(--gold); border-color:var(--gold); }

  /* ─ TESTIMONI ─ */
  .testi-grid {
    display:grid; grid-template-columns:repeat(3,1fr);
    gap:1px; background:var(--line);
    border:1px solid var(--line); border-radius:6px; overflow:hidden;
    margin-top:3rem;
  }
  .testi-card {
    background:var(--cream); padding:2rem 1.75rem;
    display:flex; flex-direction:column; gap:1rem;
    transition:background .2s;
  }
  .testi-card:hover { background:var(--sand); }
  .testi-top { display:flex; align-items:center; gap:.75rem; }
  .testi-top img {
    width:42px; height:42px; border-radius:50%;
    object-fit:cover; filter:grayscale(.25);
  }
  .testi-name { font-size:.9rem; font-weight:500; color:var(--brown); }
  .testi-role { font-size:.72rem; color:var(--muted); }
  .stars { color:var(--gold); font-size:.78rem; display:flex; gap:2px; }
  .testi-text {
    font-size:.87rem; line-height:1.8; color:var(--mid);
    font-family:'Playfair Display',serif; font-style:italic; font-weight:400;
  }

  /* ─ CONTACT ─ */
  .contact-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-top:3rem; }
  .info-card {
    background:var(--sand); border:1px solid var(--line);
    border-radius:6px; padding:2rem;
  }
  .info-card-icon {
    width:40px; height:40px; border-radius:50%; border:1px solid var(--line);
    display:flex; align-items:center; justify-content:center;
    color:var(--gold); font-size:.95rem; margin-bottom:1rem;
  }
  .info-card h4 { font-family:'Playfair Display',serif; font-weight:400; font-size:1.1rem; margin-bottom:.6rem; }
  .info-card p { font-size:.87rem; line-height:1.75; color:var(--mid); }
  .info-card iframe { display:block; border-radius:3px; margin-top:1rem; }

  .contact-links { display:flex; flex-direction:column; margin-top:1rem; }
  .contact-link {
    display:flex; align-items:center; gap:.65rem;
    font-size:.87rem; color:var(--mid); text-decoration:none;
    padding:.55rem 0; border-bottom:1px solid var(--line);
    transition:color .2s;
  }
  .contact-link:last-child { border-bottom:none; }
  .contact-link:hover { color:var(--gold); }
  .contact-link i { color:var(--gold); width:18px; }

  /* ─ JAM ─ */
  .hours {
    margin-top:1.5rem; background:var(--brown);
    border-radius:6px; padding:2.25rem 2.5rem;
    display:grid; grid-template-columns:1fr 1fr; gap:0 3rem;
  }
  .hours-title {
    grid-column:1/-1; text-align:center;
    font-family:'Playfair Display',serif; font-style:italic;
    font-size:1.15rem; color:#e8c47a; margin-bottom:1.25rem;
    padding-bottom:1rem; border-bottom:1px solid rgba(255,255,255,.08);
  }
  .hours-row {
    display:flex; justify-content:space-between;
    padding:.5rem 0; border-bottom:1px solid rgba(255,255,255,.07); font-size:.85rem;
  }
  .hours-row:last-child { border-bottom:none; }
  .hours-row span { color:rgba(249,245,240,.50); }
  .hours-row strong { color:#f9f5f0; font-weight:400; }

  /* ─ responsive ─ */
  @media(max-width:768px){
    .about-grid,.contact-grid,.testi-grid,.hours{ grid-template-columns:1fr; }
    .hours { gap:0; }
    .img-chip { right:0; }
  }
</style>
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
        <img src="https://images.unsplash.com/photo-1559925393-8be0ec4767c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80" alt="Tentang Cafe">
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

<hr class="divider">

{{-- TESTIMONI --}}
<section class="s">
  <div class="pg">
    <p class="lbl">Kata Mereka</p>
    <h2 class="title">Testimoni <em>Pelanggan</em></h2>

    <div class="testi-grid">
      <div class="testi-card">
        <div class="testi-top">
          <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="">
          <div>
            <p class="testi-name">Budi Santoso</p>
            <p class="testi-role">Pengunjung</p>
          </div>
        </div>
        <div class="stars">
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
        </div>
        <p class="testi-text">Tempatnya nyaman, kopinya enak, viewnya bagus. Cocok buat santai sama teman-teman.</p>
      </div>

      <div class="testi-card">
        <div class="testi-top">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
          <div>
            <p class="testi-name">Siti Aminah</p>
            <p class="testi-role">Pengunjung</p>
          </div>
        </div>
        <div class="stars">
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
        </div>
        <p class="testi-text">Pelayanan ramah, harga terjangkau, nasi gorengnya enak banget! Pasti balik lagi.</p>
      </div>

      <div class="testi-card">
        <div class="testi-top">
          <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="">
          <div>
            <p class="testi-name">Ahmad Rizki</p>
            <p class="testi-role">Pengunjung</p>
          </div>
        </div>
        <div class="stars">
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
        </div>
        <p class="testi-text">Kopi Bataknya mantap, suasananya adem cocok buat nongkrong sambil kerja.</p>
      </div>
    </div>
  </div>
</section>

<hr class="divider">

{{-- LOKASI & KONTAK --}}
<section class="s">
  <div class="pg">
    <p class="lbl">Temukan Kami</p>
    <h2 class="title">Lokasi &amp; <em>Kontak</em></h2>

    <div class="contact-grid">
      <div class="info-card">
        <div class="info-card-icon"><i class="bi bi-geo-alt-fill"></i></div>
        <h4>Lokasi Kami</h4>
        <p>Jl. Sisingamangaraja No. 123, Balige<br>Sumatera Utara</p>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d255281.1904021647!2d98.93868025136718!3d2.330405312315595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e00b82e8e2e5b%3A0xc03e5b7e9b9e9b9e!2sBalige%2C%20Toba%20Samosir%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1621234567890!5m2!1sid!2sid"
          width="100%" height="190" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
      </div>

      <div class="info-card">
        <div class="info-card-icon"><i class="bi bi-telephone-fill"></i></div>
        <h4>Hubungi Kami</h4>
        <p>Kami senang mendengar dari kamu.</p>
        <div class="contact-links">
          <a href="https://wa.me/6281234567890" class="contact-link">
            <i class="bi bi-whatsapp"></i>+62 812-3456-7890
          </a>
          <a href="https://instagram.com/janjimartahancoffee" class="contact-link">
            <i class="bi bi-instagram"></i>@janjimartahancoffee
          </a>
          <a href="mailto:info@janjimartahan.com" class="contact-link">
            <i class="bi bi-envelope-fill"></i>info@janjimartahan.com
          </a>
        </div>
      </div>
    </div>

    <div class="hours">
      <p class="hours-title">Jam Operasional</p>
      <div>
        <div class="hours-row"><span>Senin – Jumat</span><strong>08.00 – 22.00</strong></div>
        <div class="hours-row"><span>Sabtu</span><strong>09.00 – 23.00</strong></div>
      </div>
      <div>
        <div class="hours-row"><span>Minggu</span><strong>09.00 – 22.00</strong></div>
        <div class="hours-row"><span>Hari Libur Nasional</span><strong>09.00 – 22.00</strong></div>
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