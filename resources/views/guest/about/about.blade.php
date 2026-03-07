@extends('layouts.app')

@section('title', 'Tentang Kami')

@php
    use App\Helpers\FormatHelper;
@endphp

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600&family=DM+Sans:wght@200;300;400;500&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --ink:        #0a0705;
  --ink2:       #120e0a;
  --smoke:      #1c1410;
  --amber:      #d4892a;
  --amber-pale: #f0c978;
  --cream:      #f5efe6;
  --warm-gray:  #c8b89a;
  --muted:      rgba(255,255,255,0.38);
  --ease: cubic-bezier(.22,.68,0,1.2);
}

html { scroll-behavior: smooth; }

body {
  background: var(--ink);
  color: var(--cream);
  font-family: 'DM Sans', sans-serif;
  overflow-x: hidden;
}

/* ── CURSOR ─────────────────────────────────────── */
.cursor {
  position: fixed; z-index: 9999; pointer-events: none;
  width: 10px; height: 10px; border-radius: 50%;
  background: var(--amber);
  transform: translate(-50%,-50%);
  transition: transform 0.08s, width 0.3s var(--ease), height 0.3s var(--ease);
  mix-blend-mode: difference;
}
.cursor-ring {
  position: fixed; z-index: 9998; pointer-events: none;
  width: 40px; height: 40px; border-radius: 50%;
  border: 1px solid rgba(212,137,42,0.5);
  transform: translate(-50%,-50%);
  transition: all 0.18s ease;
}

/* ── HERO ────────────────────────────────────────── */
.hero {
  position: relative;
  height: 100vh; min-height: 680px;
  display: grid; place-items: center;
  overflow: hidden;
}

.hero__bg {
  position: absolute; inset: 0;
  background-image: url('https://images.unsplash.com/photo-1559925393-8be0ec4767c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80');
  background-size: cover; background-position: center;
  filter: brightness(0.22) saturate(0.6);
  transform: scale(1.08);
}

.hero__grain {
  position: absolute; inset: 0; z-index: 1;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.055'/%3E%3C/svg%3E");
  opacity: 0.6; pointer-events: none;
}

.hero::after {
  content: '';
  position: absolute; bottom: -1px; left: 0; right: 0; height: 260px; z-index: 2;
  background: linear-gradient(to bottom, transparent, var(--ink));
}

.hero__content {
  position: relative; z-index: 3;
  text-align: center; padding: 0 1.5rem;
}

.hero__tag {
  display: inline-flex; align-items: center; gap: 12px;
  font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase;
  color: var(--amber); font-weight: 500;
  margin-bottom: 2rem;
  opacity: 0; animation: rise 1s 0.3s forwards;
}
.hero__tag::before, .hero__tag::after {
  content: ''; width: 40px; height: 1px; background: var(--amber); opacity: 0.6;
}

.hero__title {
  font-family: 'Cormorant Garamond', serif;
  font-size: clamp(4rem, 10vw, 9rem);
  font-weight: 300; line-height: 0.95;
  letter-spacing: -0.02em; color: var(--cream);
  opacity: 0; animation: rise 1s 0.5s forwards;
}
.hero__title em { font-style: italic; color: var(--amber-pale); display: block; }

.hero__sub {
  margin-top: 2rem;
  font-size: 0.9rem; font-weight: 300;
  color: var(--muted); letter-spacing: 0.04em; line-height: 1.8;
  max-width: 380px; margin-left: auto; margin-right: auto;
  opacity: 0; animation: rise 1s 0.75s forwards;
}

.hero__scroll {
  position: absolute; bottom: 2.5rem; left: 50%; transform: translateX(-50%);
  z-index: 3; display: flex; flex-direction: column; align-items: center; gap: 8px;
  opacity: 0; animation: fadeIn 1s 1.4s forwards;
}
.hero__scroll span {
  font-size: 0.6rem; letter-spacing: 0.25em; text-transform: uppercase;
  color: rgba(255,255,255,0.3);
}
.hero__scroll-line {
  width: 1px; height: 52px;
  background: linear-gradient(to bottom, var(--amber), transparent);
  animation: pulse-line 2s 1.6s infinite;
}

/* ── MARQUEE ─────────────────────────────────────── */
.marquee-wrap {
  overflow: hidden;
  border-top: 1px solid rgba(255,255,255,0.06);
  border-bottom: 1px solid rgba(255,255,255,0.06);
  background: rgba(255,255,255,0.02);
  padding: 1rem 0;
}
.marquee-track {
  display: flex; gap: 3rem; width: max-content;
  animation: marquee 22s linear infinite;
}
.marquee-item {
  display: flex; align-items: center; gap: 1rem; white-space: nowrap;
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.05rem; font-style: italic;
  color: rgba(255,255,255,0.25); letter-spacing: 0.04em;
}
.marquee-dot { width: 5px; height: 5px; border-radius: 50%; background: var(--amber); opacity: 0.6; }

/* ── STORY ───────────────────────────────────────── */
.story { padding: 8rem 0; position: relative; }

.story__grid {
  max-width: 1280px; margin: 0 auto; padding: 0 4rem;
  display: grid; grid-template-columns: 1fr 1fr;
  gap: 6rem; align-items: start;
}

.story__visual { position: relative; }

.story__img-frame {
  position: relative; border-radius: 2px; overflow: hidden;
}
.story__img-frame::before {
  content: '';
  position: absolute; inset: 0; z-index: 1;
  background: linear-gradient(135deg, rgba(212,137,42,0.15), transparent 50%);
}
.story__img-frame img {
  width: 100%; aspect-ratio: 3/4; object-fit: cover; display: block;
  filter: saturate(0.75) contrast(1.1);
  transition: filter 0.6s, transform 0.8s var(--ease);
}
.story__img-frame:hover img {
  filter: saturate(1) contrast(1.05); transform: scale(1.03);
}

.story__counter {
  position: absolute; bottom: -1.5rem; right: -1.5rem;
  width: 110px; height: 110px;
  background: var(--amber); border-radius: 50%;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  z-index: 2;
  box-shadow: 0 0 0 8px var(--ink), 0 0 0 9px rgba(212,137,42,0.3);
}
.story__counter-num {
  font-family: 'Cormorant Garamond', serif;
  font-size: 2rem; font-weight: 600; line-height: 1; color: var(--ink);
}
.story__counter-label {
  font-size: 0.55rem; letter-spacing: 0.12em; text-transform: uppercase;
  color: rgba(10,7,5,0.7); font-weight: 500;
}

.story__deco {
  position: absolute; top: 3rem; left: -1.5rem;
  width: 3px; height: 60%;
  background: linear-gradient(to bottom, var(--amber), transparent);
  border-radius: 3px;
}

.story__text { padding-top: 2rem; }

.label-tag {
  display: inline-flex; align-items: center; gap: 10px;
  font-size: 0.62rem; letter-spacing: 0.28em; text-transform: uppercase;
  color: var(--amber); font-weight: 500; margin-bottom: 1.5rem;
}
.label-tag::before { content: ''; width: 28px; height: 1px; background: var(--amber); }

.story__heading {
  font-family: 'Cormorant Garamond', serif;
  font-size: clamp(2.4rem, 4vw, 3.6rem);
  font-weight: 300; line-height: 1.15; color: var(--cream);
  margin-bottom: 2.5rem;
}
.story__heading em { font-style: italic; color: var(--amber-pale); }

/* rich text */
.rich-text h1, .rich-text h2 {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.5rem; font-weight: 600;
  color: var(--amber-pale); margin: 2.5rem 0 1rem;
}
.rich-text h3 {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.2rem; font-weight: 400; font-style: italic;
  color: var(--warm-gray); margin: 1.75rem 0 0.75rem;
}
.rich-text p {
  font-size: 0.93rem; line-height: 1.9; color: rgba(245,239,230,0.7);
  margin-bottom: 1.1rem; font-weight: 300;
}
.rich-text > p:first-of-type {
  font-size: 1.05rem; color: rgba(245,239,230,0.85);
  font-weight: 300; line-height: 1.8;
}
.rich-text ul, .rich-text ol { padding-left: 1.4rem; margin-bottom: 1.25rem; }
.rich-text li {
  font-size: 0.91rem; line-height: 1.8; color: rgba(245,239,230,0.65);
  margin-bottom: 0.4rem; font-weight: 300;
}
.rich-text strong { color: var(--cream); font-weight: 500; }
.rich-text a { color: var(--amber-pale); text-decoration: none; border-bottom: 1px solid rgba(212,137,42,0.4); transition: border-color 0.2s; }
.rich-text a:hover { border-color: var(--amber); }

/* ── ORDER BOX ───────────────────────────────────── */
.order-section {
  max-width: 1280px; margin: 0 auto; padding: 0 4rem 8rem;
}
.order-glass {
  background: rgba(255,255,255,0.03);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 16px; padding: 3.5rem 4rem;
  position: relative; overflow: hidden;
  backdrop-filter: blur(20px);
}
.order-glass::before {
  content: '';
  position: absolute; top: -80px; right: -80px;
  width: 280px; height: 280px; border-radius: 50%;
  background: radial-gradient(circle, rgba(212,137,42,0.18), transparent 70%);
  pointer-events: none;
}
.order-inner { position: relative; z-index: 1; }

/* ── FEATURES ────────────────────────────────────── */
.features {
  padding: 6rem 0 8rem;
  background: var(--ink2); overflow: hidden; position: relative;
}
.features::before {
  content: '';
  position: absolute; inset: 0;
  background:
    radial-gradient(ellipse at 15% 50%, rgba(212,137,42,0.07) 0%, transparent 55%),
    radial-gradient(ellipse at 85% 20%, rgba(212,137,42,0.05) 0%, transparent 50%);
  pointer-events: none;
}
.features__header { text-align: center; margin-bottom: 5rem; }
.features__header .label-tag { justify-content: center; }
.features__title {
  font-family: 'Cormorant Garamond', serif;
  font-size: clamp(2.2rem, 5vw, 4rem);
  font-weight: 300; color: var(--cream); letter-spacing: -0.01em;
}

.features__grid {
  max-width: 1280px; margin: 0 auto; padding: 0 4rem;
  display: grid; grid-template-columns: repeat(3, 1fr);
  gap: 1.5px;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.05);
  border-radius: 12px; overflow: hidden;
}

.feat-card {
  background: var(--ink2); padding: 3.5rem 2.5rem;
  position: relative; overflow: hidden;
  transition: background 0.4s; cursor: default;
}
.feat-card::before {
  content: '';
  position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
  background: linear-gradient(to right, transparent, var(--amber), transparent);
  transform: scaleX(0); transition: transform 0.4s var(--ease);
}
.feat-card:hover { background: rgba(255,255,255,0.03); }
.feat-card:hover::before { transform: scaleX(1); }

.feat-card__num {
  position: absolute; top: 1rem; right: 1.5rem;
  font-family: 'Cormorant Garamond', serif;
  font-size: 5rem; font-weight: 600;
  color: rgba(255,255,255,0.03);
  line-height: 1; user-select: none;
  transition: color 0.4s;
}
.feat-card:hover .feat-card__num { color: rgba(212,137,42,0.07); }

.feat-card__icon {
  width: 52px; height: 52px;
  border: 1px solid rgba(212,137,42,0.35); border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  margin-bottom: 2rem; position: relative;
  transition: border-color 0.3s, background 0.3s;
}
.feat-card__icon::after {
  content: '';
  position: absolute; inset: 5px; border-radius: 50%;
  background: rgba(212,137,42,0.06); transition: background 0.3s;
}
.feat-card:hover .feat-card__icon { border-color: var(--amber); }
.feat-card:hover .feat-card__icon::after { background: rgba(212,137,42,0.12); }
.feat-card__icon i { font-size: 1.3rem; color: var(--amber); position: relative; z-index: 1; }

.feat-card__title {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.5rem; font-weight: 400; color: var(--cream); margin-bottom: 0.85rem;
}
.feat-card__desc {
  font-size: 0.85rem; line-height: 1.75;
  color: rgba(255,255,255,0.38); font-weight: 300;
}

/* ── CTA BAR ─────────────────────────────────────── */
.cta-bar {
  background: var(--amber); padding: 2.5rem 4rem;
  display: flex; align-items: center; justify-content: space-between;
  gap: 2rem; flex-wrap: wrap; position: relative; overflow: hidden;
}
.cta-bar::before {
  content: '☕';
  position: absolute; right: 6rem; top: 50%; transform: translateY(-50%);
  font-size: 10rem; opacity: 0.07; line-height: 1; pointer-events: none;
}
.cta-bar__text {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.8rem; font-weight: 400; font-style: italic; color: var(--ink);
}
.cta-bar__btn {
  display: inline-flex; align-items: center; gap: 10px;
  background: var(--ink); color: var(--amber-pale);
  padding: 0.85rem 2rem; border-radius: 100px;
  font-size: 0.78rem; letter-spacing: 0.15em; text-transform: uppercase; font-weight: 500;
  text-decoration: none; transition: background 0.3s, transform 0.2s; white-space: nowrap;
}
.cta-bar__btn:hover { background: #1c1410; transform: translateX(3px); }

/* ── ANIMATIONS ──────────────────────────────────── */
@keyframes rise {
  from { opacity: 0; transform: translateY(30px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
@keyframes pulse-line {
  0%,100% { transform: scaleY(0.5); opacity: 0.4; }
  50%      { transform: scaleY(1);   opacity: 1; }
}

.reveal {
  opacity: 0; transform: translateY(36px);
  transition: opacity 0.85s var(--ease), transform 0.85s var(--ease);
}
.reveal.visible { opacity: 1; transform: translateY(0); }
.reveal-d1 { transition-delay: 0.12s; }
.reveal-d2 { transition-delay: 0.24s; }
.reveal-d3 { transition-delay: 0.36s; }

/* ── RESPONSIVE ──────────────────────────────────── */
@media (max-width: 1024px) {
  .story__grid { grid-template-columns: 1fr; gap: 4rem; padding: 0 2.5rem; }
  .story__deco { display: none; }
  .order-section { padding: 0 2.5rem 6rem; }
  .features__grid { grid-template-columns: 1fr; padding: 0 2.5rem; }
  .cta-bar { padding: 2.5rem; }
}
@media (max-width: 640px) {
  .story__grid { padding: 0 1.5rem; }
  .order-glass { padding: 2rem 1.75rem; }
  .hero__title { font-size: clamp(3rem, 14vw, 5rem); }
  .cta-bar { flex-direction: column; text-align: center; }
  .features__grid { gap: 0; }
}
</style>
@endpush

@section('content')

<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

{{-- ░░ HERO ░░ --}}
<section class="hero">
  <div class="hero__bg" id="heroBg"></div>
  <div class="hero__grain"></div>
  <div class="hero__content">
    <p class="hero__tag">Kisah &amp; Semangat Kami</p>
    <h1 class="hero__title">
      Janji<br>
      <em>Martahan</em>
    </h1>
    <p class="hero__sub">
      Lebih dari sekadar kopi — sebuah tempat berkumpul,<br>
      momen istirahat, dan cerita yang belum selesai.
    </p>
  </div>
  <div class="hero__scroll">
    <div class="hero__scroll-line"></div>
    <span>Gulir</span>
  </div>
</section>

{{-- ░░ MARQUEE ░░ --}}
<div class="marquee-wrap">
  <div class="marquee-track">
    @foreach(range(1,8) as $i)
      <span class="marquee-item">
        <span class="marquee-dot"></span>
        Specialty Coffee
        <span class="marquee-dot"></span>
        Asri &amp; Nyaman
        <span class="marquee-dot"></span>
        Ramah Keluarga
        <span class="marquee-dot"></span>
        Biji Pilihan Lokal
      </span>
    @endforeach
  </div>
</div>

{{-- ░░ STORY ░░ --}}
@if($about)
  @php
    $deskripsi = $about->deskripsi;
    $howToOrder = '';
    if (preg_match('/## HOW TO ORDER(.*?)(?=##|$)/s', $deskripsi, $matches)) {
      $howToOrder = $matches[0];
      $howToOrder = FormatHelper::parseManualFormat($howToOrder);
      $deskripsi  = str_replace($matches[0], '', $deskripsi);
    }
    $kontenUtama = FormatHelper::parseManualFormat($deskripsi);
  @endphp

  <section class="story">
    <div class="story__grid">
      <div class="story__visual reveal">
        <div class="story__deco"></div>
        <div class="story__img-frame">
          <img
            src="{{ $about->gambar ? asset('uploads/about/'.$about->gambar) : 'https://images.unsplash.com/photo-1559925393-8be0ec4767c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80' }}"
            alt="{{ $about->judul ?? 'Janji Martahan Coffee' }}"
            loading="lazy">
        </div>
        <div class="story__counter">
          <span class="story__counter-num">2019</span>
          <span class="story__counter-label">Est.</span>
        </div>
      </div>
      <div class="story__text reveal reveal-d1">
        <p class="label-tag">Tentang Kami</p>
        <h2 class="story__heading">
          {{ $about->judul ?? 'Janji Martahan Coffee' }}<br>
          <em>— Hadir untuk Kamu</em>
        </h2>
        @if($kontenUtama)
          <div class="rich-text">{!! $kontenUtama !!}</div>
        @endif
      </div>
    </div>
  </section>

  @if($howToOrder)
    <div class="order-section reveal">
      <div class="order-glass">
        <div class="order-inner rich-text">{!! $howToOrder !!}</div>
      </div>
    </div>
  @endif

@else
  <div style="text-align:center;padding:8rem 2rem;color:rgba(255,255,255,0.3)">
    <i class="bi bi-cup-hot" style="font-size:3rem;color:var(--amber)"></i>
    <p style="margin-top:1.25rem;font-size:0.9rem">Informasi sedang dalam pengembangan</p>
  </div>
@endif

{{-- ░░ FEATURES ░░ --}}
<section class="features">
  <div class="features__header reveal">
    <p class="label-tag">Mengapa Kami</p>
    <h2 class="features__title">Yang Membuat Kami<br><em style="font-family:'Cormorant Garamond',serif;font-style:italic;color:var(--amber-pale)">Berbeda</em></h2>
  </div>
  <div class="features__grid">
    <div class="feat-card reveal">
      <span class="feat-card__num">01</span>
      <div class="feat-card__icon"><i class="bi bi-cup-hot-fill"></i></div>
      <h3 class="feat-card__title">Kopi Berkualitas</h3>
      <p class="feat-card__desc">Setiap biji dipilih dengan cermat dari petani lokal terpercaya, diseduh dengan metode yang tepat untuk menghadirkan cita rasa terbaik di setiap cangkir.</p>
    </div>
    <div class="feat-card reveal reveal-d1">
      <span class="feat-card__num">02</span>
      <div class="feat-card__icon"><i class="bi bi-tree-fill"></i></div>
      <h3 class="feat-card__title">Suasana Asri</h3>
      <p class="feat-card__desc">Nikmati kehijauan alam di setiap sudut. Kami merancang ruang yang menyatu dengan lingkungan, memberi ketenangan di tengah kesibukan hari-harimu.</p>
    </div>
    <div class="feat-card reveal reveal-d2">
      <span class="feat-card__num">03</span>
      <div class="feat-card__icon"><i class="bi bi-people-fill"></i></div>
      <h3 class="feat-card__title">Ramah Keluarga</h3>
      <p class="feat-card__desc">Tempat yang hangat untuk semua kalangan. Dari momen santai bersama keluarga hingga pertemuan ringan bersama sahabat — semua terasa pas di sini.</p>
    </div>
  </div>
</section>

{{-- ░░ CTA BAR ░░ --}}
<div class="cta-bar">
  <p class="cta-bar__text">"Kunjungi kami dan rasakan bedanya."</p>
  <a href="#" class="cta-bar__btn">
    Lihat Menu &nbsp;<i class="bi bi-arrow-right"></i>
  </a>
</div>

@endsection

@push('scripts')
<script>
(function () {
  /* custom cursor */
  const cur  = document.getElementById('cursor');
  const ring = document.getElementById('cursorRing');
  if (window.matchMedia('(pointer:fine)').matches) {
    document.addEventListener('mousemove', e => {
      cur.style.left  = e.clientX + 'px';
      cur.style.top   = e.clientY + 'px';
      ring.style.left = e.clientX + 'px';
      ring.style.top  = e.clientY + 'px';
    });
    document.querySelectorAll('a,button').forEach(el => {
      el.addEventListener('mouseenter', () => {
        cur.style.width = '20px'; cur.style.height = '20px';
        ring.style.width = '60px'; ring.style.height = '60px';
      });
      el.addEventListener('mouseleave', () => {
        cur.style.width = '10px'; cur.style.height = '10px';
        ring.style.width = '40px'; ring.style.height = '40px';
      });
    });
  } else {
    cur.style.display = ring.style.display = 'none';
  }

  /* scroll reveal */
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
  }, { threshold: 0.1 });
  document.querySelectorAll('.reveal').forEach(el => io.observe(el));

  /* hero parallax */
  const bg = document.getElementById('heroBg');
  if (bg) {
    window.addEventListener('scroll', () => {
      bg.style.transform = `scale(1.08) translateY(${window.scrollY * 0.22}px)`;
    }, { passive: true });
  }
})();
</script>
@endpush