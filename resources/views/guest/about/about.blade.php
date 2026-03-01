@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<!-- Header -->
<div class="bg-dark text-white py-5" style="margin-top: -76px; background: #2c1810;">
    <div class="container py-4">
        <h1 class="text-center">{{ $about->judul ?? 'Tentang Janji Martahan Coffee' }}</h1>
    </div>
</div>

<!-- Konten About -->
<div class="container py-5">
    @if($about)
        <div class="row">
            <!-- Kolom Kiri: Gambar dan HOW TO ORDER -->
            <div class="col-md-6">
                <!-- Gambar -->
                @if($about->gambar)
                    <img src="{{ asset('uploads/about/'.$about->gambar) }}" 
                         alt="Janji Martahan Coffee" 
                         class="img-fluid rounded mb-4">
                @else
                    <img src="https://images.unsplash.com/photo-1559925393-8be0ec4767c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80" 
                         alt="Janji Martahan Coffee" 
                         class="img-fluid rounded mb-4">
                @endif

                <!-- HOW TO ORDER (di bawah gambar) -->
                <h4 class="mb-3">HOW TO ORDER</h4>
                <div class="how-to-order-content">
                    {!! nl2br(e($about->how_to_order)) !!}
                </div>

                <!-- TOMBOL DIHAPUS - TATA LETAK TETAP SAMA -->
            </div>

            <!-- Kolom Kanan: Info Tahun, Sejarah, Visi -->
            <div class="col-md-6">
                @if($about->tahun_berdiri || $about->lokasi)
                    <div class="mb-3">
                        @if($about->tahun_berdiri)
                            <span class="badge me-2" style="background: #c4a27a;">Berdiri: {{ $about->tahun_berdiri }}</span>
                        @endif
                        @if($about->lokasi)
                            <span class="badge" style="background: #c4a27a;">{{ $about->lokasi }}</span>
                        @endif
                    </div>
                @endif
                
                <h3 class="mb-3">Sejarah Singkat</h3>
                <p>{{ $about->sejarah }}</p>
                
                <h4 class="mt-4 mb-3">Visi</h4>
                <p>{{ $about->visi }}</p>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-info-circle fs-1 text-muted"></i>
            <p class="mt-3">Informasi tentang kami sedang dalam pengembangan.</p>
        </div>
    @endif
</div>

<!-- Info Sederhana (Diperkecil) -->
<div class="bg-light py-3">
    <div class="container">
        <div class="row text-center">
            <div class="col-4">
                <i class="bi bi-cup-hot" style="color: #c4a27a; font-size: 1.5rem;"></i>
                <p class="mt-1 mb-0 small">Kopi Berkualitas</p>
            </div>
            <div class="col-4">
                <i class="bi bi-tree" style="color: #c4a27a; font-size: 1.5rem;"></i>
                <p class="mt-1 mb-0 small">Suasana Asri</p>
            </div>
            <div class="col-4">
                <i class="bi bi-people" style="color: #c4a27a; font-size: 1.5rem;"></i>
                <p class="mt-1 mb-0 small">Ramah Keluarga</p>
            </div>
        </div>
    </div>
</div>

<style>
.how-to-order-content {
    line-height: 1.8;
}
.how-to-order-content br {
    display: block;
    margin: 8px 0;
    content: "";
}
</style>
@endsection