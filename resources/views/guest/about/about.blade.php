@extends('layouts.app')

@section('title', 'Tentang Kami')

@php
    use App\Helpers\FormatHelper;
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')
<!-- Header -->
<div style="background: #2c1810; margin-top: -76px;">
    <div class="container py-5">
        <h1 class="text-center text-white">{{ $about->judul ?? 'Tentang Janji Martahan Coffee' }}</h1>
    </div>
</div>

<!-- Konten About -->
<div class="container py-5">
    @if($about)
        @php
            $deskripsi = $about->deskripsi;
            
            // 1. AMBIL BAGIAN HOW TO ORDER (UNTUK DI BAWAH GAMBAR)
            $howToOrder = '';
            if (preg_match('/## HOW TO ORDER(.*?)(?=##|$)/s', $deskripsi, $matches)) {
                $howToOrder = $matches[0]; // Ambil termasuk judulnya
                $howToOrder = FormatHelper::parseManualFormat($howToOrder);
                
                // Hapus HOW TO ORDER dari deskripsi utama
                $deskripsi = str_replace($matches[0], '', $deskripsi);
            }
            
            // 2. SISA KONTEN (UNTUK DI KANAN)
            $kontenUtama = FormatHelper::parseManualFormat($deskripsi);
        @endphp

        <div class="row">
            <!-- Kolom Kiri: Gambar + HOW TO ORDER -->
            <div class="col-md-6">
                <!-- Gambar -->
                @if($about->gambar)
                    <img src="{{ asset('uploads/about/'.$about->gambar) }}" 
                         alt="Janji Martahan Coffee" 
                         class="img-fluid rounded mb-4 w-100">
                @else
                    <img src="https://images.unsplash.com/photo-1559925393-8be0ec4767c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80" 
                         alt="Janji Martahan Coffee" 
                         class="img-fluid rounded mb-4 w-100">
                @endif

                <!-- HOW TO ORDER (DI BAWAH GAMBAR) -->
                @if($howToOrder)
                    <div class="how-to-order-section">
                        {!! $howToOrder !!}
                    </div>
                @endif
            </div>
            
            <!-- Kolom Kanan: Tentang Kami dan Our Vision -->
            <div class="col-md-6">
                @if($kontenUtama)
                    <div class="about-content">
                        {!! $kontenUtama !!}
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-info-circle fs-1 text-muted"></i>
            <p class="mt-3">Informasi tentang kami sedang dalam pengembangan.</p>
        </div>
    @endif
</div>

<!-- Info Sederhana -->
<div class="bg-light py-4">
    <div class="container">
        <div class="row text-center">
            <div class="col-4">
                <i class="bi bi-cup-hot fs-2" style="color: #c4a27a;"></i>
                <p class="mt-2">Kopi Berkualitas</p>
            </div>
            <div class="col-4">
                <i class="bi bi-tree fs-2" style="color: #c4a27a;"></i>
                <p class="mt-2">Suasana Asri</p>
            </div>
            <div class="col-4">
                <i class="bi bi-people fs-2" style="color: #c4a27a;"></i>
                <p class="mt-2">Ramah Keluarga</p>
            </div>
        </div>
    </div>
</div>


</style>
@endsection