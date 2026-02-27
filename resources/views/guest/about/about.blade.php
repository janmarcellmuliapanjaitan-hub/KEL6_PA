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
            <div class="col-md-6 mb-4">
                @if($about->gambar)
                    <img src="{{ asset('uploads/about/'.$about->gambar) }}" 
                         alt="Janji Martahan Coffee" 
                         class="img-fluid rounded">
                @else
                    <img src="https://images.unsplash.com/photo-1559925393-8be0ec4767c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80" 
                         alt="Janji Martahan Coffee" 
                         class="img-fluid rounded">
                @endif
            </div>
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
                
                <h4 class="mt-4 mb-3">Misi</h4>
                <p>{{ $about->misi }}</p>
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
@endsection