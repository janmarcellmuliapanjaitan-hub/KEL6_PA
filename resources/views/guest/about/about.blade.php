@extends('layouts.app')

@section('title', 'Tentang Kami')

@php
    use App\Helpers\FormatHelper;
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
@endpush

@section('content')

{{-- ── PAGE HERO ── --}}
<div class="page-hero">
    <img src="{{ $about && $about->gambar ? asset('uploads/about/'.$about->gambar) : 'https://images.unsplash.com/photo-1559925393-8be0ec4767c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80' }}" alt="">
    <div class="page-hero__body">
        <p class="page-hero__eyebrow">Janji Martahan Coffee</p>
        <h1>{{ $about->judul ?? 'Tentang Janji Martahan Coffee' }}</h1>
    </div>
</div>

<hr class="divider">

{{-- ── MAIN CONTENT ── --}}
<section class="s">
    <div class="pg">
        <p class="lbl">Kisah Kami</p>
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

                {{-- LEFT — foto saja --}}
                <div>
                    <div class="img-wrap">
                        <img src="{{ $about->gambar ? asset('uploads/about/'.$about->gambar) : 'https://images.unsplash.com/photo-1559925393-8be0ec4767c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80' }}"
                             alt="Janji Martahan Coffee">
                        <div class="img-chip">
                            <strong>2025</strong>
                            <span>Berdiri sejak</span>
                        </div>
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
                            <p>Informasi tentang Janji Martahan Coffee akan segera hadir. Kami sedang mempersiapkan cerita dan filosofi di balik setiap cangkir kopi yang kami sajikan.</p>
                        </div>
                    @endif
                </div>

            </div>

            {{-- HOW TO ORDER — full-width card di bawah grid --}}
            @if($howToOrder)
                <div class="order-banner">
                    <div class="order-banner__left">
                        <p class="lbl-dark">Panduan</p>
                        <h3>How to<br>Order</h3>
                    </div>
                    <div class="order-banner__body" style="color:#f0e8dc;">
                        {!! $howToOrder !!}
                    </div>
                </div>
            @endif

        @else
            <div class="about-empty">
                <i class="bi bi-cup-hot"></i>
                <p>Informasi sedang dalam pengembangan</p>
            </div>
        @endif
    </div>
</section>

<hr class="divider">


@endsection