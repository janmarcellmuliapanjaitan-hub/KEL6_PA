@extends('layouts.app')

@section('title', 'Tentang Kami')

@php
    use App\Helpers\FormatHelper;
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')
<!-- Simple Header -->
<div class="page-header">
    <div class="container">
        <h1>{{ $about->judul ?? 'Tentang Janji Martahan Coffee' }}</h1>
    </div>
</div>

<!-- Main Content -->
<div class="container py-5">
    @if($about)
        @php
            $deskripsi = $about->deskripsi;
            
            // 1. AMBIL BAGIAN HOW TO ORDER
            $howToOrder = '';
            if (preg_match('/## HOW TO ORDER(.*?)(?=##|$)/s', $deskripsi, $matches)) {
                $howToOrder = $matches[0];
                $howToOrder = FormatHelper::parseManualFormat($howToOrder);
                $deskripsi = str_replace($matches[0], '', $deskripsi);
            }
            
            // 2. SISA KONTEN
            $kontenUtama = FormatHelper::parseManualFormat($deskripsi);
        @endphp

        <div class="row g-4">
            <!-- Left Column -->
            <div class="col-md-6">
                <!-- Image -->
                <img src="{{ $about->gambar ? asset('uploads/about/'.$about->gambar) : 'https://images.unsplash.com/photo-1559925393-8be0ec4767c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80' }}" 
                     alt="Janji Martahan Coffee" 
                     class="about-image">
                
                <!-- How to Order -->
                @if($howToOrder)
                    <div class="order-box">
                        {!! $howToOrder !!}
                    </div>
                @endif
            </div>
            
            <!-- Right Column -->
            <div class="col-md-6">
                @if($kontenUtama)
                    <div class="content-section">
                        {!! $kontenUtama !!}
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cup-hot fs-1" style="color: #c4a27a;"></i>
            <p class="mt-3">Informasi sedang dalam pengembangan</p>
        </div>
    @endif
</div>

<!-- Simple Divider -->
<div class="divider"></div>

<!-- Simple Features -->
<div class="container pb-5">
    <div class="row">
        <div class="col-4">
            <div class="feature-item">
                <i class="bi bi-cup-hot"></i>
                <p>Kopi Berkualitas</p>
            </div>
        </div>
        <div class="col-4">
            <div class="feature-item">
                <i class="bi bi-tree"></i>
                <p>Suasana Asri</p>
            </div>
        </div>
        <div class="col-4">
            <div class="feature-item">
                <i class="bi bi-people"></i>
                <p>Ramah Keluarga</p>
            </div>
        </div>
    </div>
</div>
@endsection
bagian ini nya?