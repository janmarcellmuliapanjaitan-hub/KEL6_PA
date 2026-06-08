@extends('layouts.app')

@section('title', 'Tentang Kami')

@php
    use App\Helpers\FormatHelper;
@endphp

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')

{{-- ── PREMIUM HERO ── --}}
<div class="page-hero">
    <img src="{{ $about && $about->gambar ? asset('uploads/about/'.$about->gambar) : 'https://images.unsplash.com/photo-1559925393-8be0ec4767c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80' }}" alt="Janji Martahan Coffee">
    <div class="page-hero__body">
        <div class="page-hero__eyebrow">
            <span>Janji Martahan Coffee</span>
        </div>
        <h1>{{ $about->judul ?? 'Tentang Janji Martahan Coffee' }}</h1>
    </div>
</div>

<hr class="divider">

{{-- ── MAIN CONTENT ── --}}
<section class="s">
    <div class="pg">
        <div class="lbl">Kisah Kami</div>
        <h2 class="title">Mengenal <em>Janji Martahan</em></h2>

        @if($about)
            @php
                $deskripsi = $about->deskripsi ?? '';

                $howToOrder = '';
                if ($deskripsi && preg_match('/## HOW TO ORDER(.*?)(?=##|$)/s', $deskripsi, $matches)) {
                    $howToOrder = $matches[0];
                    $howToOrder = FormatHelper::parseManualFormat($howToOrder);
                    $deskripsi  = str_replace($matches[0], '', $deskripsi);
                }

                $kontenUtama = $deskripsi ? FormatHelper::parseManualFormat($deskripsi) : '';
            @endphp

            <div class="about-grid">

                {{-- LEFT — image dengan efek premium --}}
                <div style="position: relative;">
                    <div class="img-wrap">
                        <img src="{{ $about->gambar ? asset('uploads/about/'.$about->gambar) : 'https://images.unsplash.com/photo-1559925393-8be0ec4767c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80' }}"
                             alt="Janji Martahan Coffee">
                    </div>
                    <div class="img-chip">
                        <strong>2025</strong>
                        <span>Berdiri sejak</span>
                    </div>
                </div>

                {{-- RIGHT — konten utama --}}
                <div>
                    @if($kontenUtama)
                        <div class="about-content">
                            {!! $kontenUtama !!}
                        </div>
                    @else
                        <div class="about-content">
                            <p>✨ Informasi tentang Janji Martahan Coffee akan segera hadir. Kami sedang mempersiapkan cerita dan filosofi di balik setiap cangkir kopi yang kami sajikan.</p>
                            <p>Setiap tegukan kopi kami membawa cerita tentang passion, dedikasi, dan cinta terhadap budaya kopi Indonesia.</p>
                        </div>
                    @endif
                </div>

            </div>

            {{-- HOW TO ORDER — banner premium di bawah grid --}}
            @if($howToOrder)
                <div class="order-banner">
                    <div class="order-banner__left">
                        <div class="lbl-dark">Panduan</div>
                        <h3>How to<br>Order</h3>
                    </div>
                    <div class="order-banner__body">
                        {!! $howToOrder !!}
                    </div>
                </div>
            @endif

        @else
            <div class="about-empty">
                <i class="fas fa-mug-hot"></i>
                <p>Informasi sedang dalam pengembangan</p>
                <p style="font-size: 0.85rem; margin-top: 0.5rem;">Kami akan segera hadir dengan cerita yang menarik</p>
            </div>
        @endif
    </div>
</section>

<hr class="divider">

@endsection

@push('scripts')
<script src="{{ asset('js/about.js') }}"></script>
@endpush