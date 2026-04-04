@extends('layouts.app')

@section('title', 'Galeri - Janji Martahan Coffee')

@push('styles')
<style>
    .gallery-header {
        background: linear-gradient(rgba(44, 24, 16, 0.8), rgba(44, 24, 16, 0.8)), url('https://images.unsplash.com/photo-1497935586351-b67a49e012bf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80') center/cover;
        color: white;
        padding: 100px 0 60px;
        text-align: center;
        margin-top: -76px;
    }

    .gallery-item {
        margin-bottom: 24px;
        transition: all 0.3s;
    }

    .gallery-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        height: 100%;
        background: #fff;
    }

    .media-container {
        position: relative;
        overflow: hidden;
        aspect-ratio: 3 / 4;
        background: #f8f9fa;
    }

    .media-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .gallery-card:hover .media-container img {
        transform: scale(1.05);
    }

    .gallery-body {
        padding: 20px;
    }

    .gallery-desc {
        color: #555;
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .gallery-header {
            padding: 80px 15px 40px;
            margin-top: -56px;
        }

        .gallery-header h1 {
            font-size: 2rem;
        }

        .gallery-header p {
            font-size: 0.95rem;
        }

        .gallery-item {
            width: 50%;
            padding: 0 6px;
            margin-bottom: 12px;
            float: left;
            box-sizing: border-box;
        }

        .media-container {
            aspect-ratio: 3 / 3.5;
        }

        .gallery-body {
            padding: 10px 12px;
        }

        .gallery-desc {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 400px) {
        .gallery-item {
            width: 100%;
            float: none;
            padding: 0;
        }

        .media-container {
            aspect-ratio: 4 / 3;
        }
    }
</style>
@endpush

@section('content')
<div class="gallery-header">
    <div class="container mt-5">
        <h1 class="display-4 fw-bold mb-3">Galeri Kami</h1>
        <p class="lead mb-0">Dokumentasi suasana, produk, dan kegiatan di Janji Martahan Coffee.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-3">
        @forelse($galleries as $item)
            <div class="col-md-6 col-lg-4 gallery-item">
                <div class="gallery-card">
                    <div class="media-container">
                        <img src="{{ asset('storage/' . $item->file_path) }}" alt="Gallery Image" loading="lazy">
                    </div>
                    @if($item->description)
                    <div class="gallery-body">
                        <p class="gallery-desc">{{ $item->description }}</p>
                    </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-images text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3 text-muted">Belum ada foto galeri yang ditambahkan.</h4>
            </div>
        @endforelse
    </div>
</div>
@endsection