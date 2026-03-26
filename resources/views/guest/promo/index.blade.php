@extends('layouts.app')

@section('title', 'Promo - Janji Martahan Coffee')

@section('content')
<div class="container py-5 mt-4">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold" style="color: #2c1810;">Promo & Penawaran Spesial</h2>
        <p class="text-muted">Nikmati berbagai promo menarik dari Janji Martahan Coffee</p>
        <hr class="w-25 mx-auto">
    </div>

    @if($promos->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-tags text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3 text-muted">Belum ada promo saat ini.</h4>
            <p>Nantikan penawaran menarik kami selanjutnya!</p>
        </div>
    @else
        <div class="row g-4 justify-content-center">
            @foreach($promos as $promo)
                <div class="col-md-10 col-lg-8">
                    <div class="card h-100 shadow border-0" style="border-radius: 16px; overflow: hidden;">
                        @if($promo->image)
                            <img src="{{ Storage::url($promo->image) }}" class="card-img-top w-100" alt="{{ $promo->title }}" style="max-height: 500px; object-fit: contain; background-color: #f8f9fa;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 400px;">
                                <i class="bi bi-image text-muted" style="font-size: 5rem;"></i>
                            </div>
                        @endif
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title fw-bold" style="color: #2c1810;">{{ $promo->title }}</h5>
                            <p class="card-text text-muted mb-4 flex-grow-1">{{ $promo->description }}</p>
                            
                            <div class="mt-auto">
                                @if($promo->valid_until)
                                    @php
                                        $validUntil = \Carbon\Carbon::parse($promo->valid_until);
                                        $isPast = $validUntil->isPast();
                                    @endphp
                                    <div class="d-flex align-items-center {{ $isPast ? 'text-danger' : 'text-success' }}">
                                        <i class="bi bi-clock-history me-2"></i>
                                        <span class="small fw-semibold">
                                            {{ $isPast ? 'Berlaku Hingga: ' : 'Berlaku Sampai: ' }}
                                            {{ $validUntil->translatedFormat('d F Y') }}
                                        </span>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center text-primary">
                                        <i class="bi bi-infinity me-2"></i>
                                        <span class="small fw-semibold">Berlaku Selamanya</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
