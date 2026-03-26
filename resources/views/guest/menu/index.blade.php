@extends('layouts.app')

@section('title', 'Menu Kami')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush

@section('content')

<div class="menu-container">
    
    <div class="cart-float-btn">
        @auth
            <a href="{{ route('guest.cart.index') }}">
                <i class="fas fa-shopping-cart"></i> Keranjang
                @php
                    $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                @endphp
                @if($cartCount > 0)
                    <span class="cart-badge">{{ $cartCount }}</span>
                @endif
            </a>
        @else
            <a href="{{ route('guest.register.form') }}" onclick="alert('Silakan daftar menjadi pelanggan terlebih dahulu untuk melihat keranjang.')">
                <i class="fas fa-shopping-cart"></i> Keranjang
            </a>
        @endauth
    </div>

    <h2 class="menu-title-main">Menu Spesial Kami</h2>
    
    <div class="menu-filter">
        <button class="filter-btn active" data-filter="all">Semua Menu</button>
        <button class="filter-btn" data-filter="Kopi">Kopi</button>
        <button class="filter-btn" data-filter="Non Kopi">Non Kopi</button>
        <button class="filter-btn" data-filter="Snack">Snack</button>
    </div>

    @if(session('success'))
        <div class="menu-alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="menu-grid">
        @forelse($menus as $category => $items)
            @foreach($items as $menu)
                <div class="menu-item show" data-category="{{ $menu->category }}">
                    <div class="menu-card">
                        @if($menu->image)
                            <img src="{{ asset($menu->image) }}" class="menu-img" alt="{{ $menu->name }}">
                        @else
                            <div class="menu-img-empty">Tanpa Gambar</div>
                        @endif
                        <h3 class="menu-title">{{ $menu->name }}</h3>
                        <p class="menu-desc">{{ Str::limit($menu->description, 60) }}</p>
                        <div class="menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                        
                        @auth
                            <form action="{{ route('guest.cart.add', $menu->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn-add-cart">
                                    <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                                </button>
                            </form>
                        @else
                            <a href="{{ route('guest.register.form') }}" class="btn-add-cart" onclick="alert('Silakan daftar menjadi pelanggan terlebih dahulu untuk melakukan pemesanan.')">
                                <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                            </a>
                        @endauth
                    </div>
                </div>
            @endforeach
        @empty
            <div class="menu-empty-message">
                Belum ada menu yang tersedia.
            </div>
        @endforelse
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const menuItems = document.querySelectorAll('.menu-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');

            menuItems.forEach(item => {
                if(filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.classList.add('show');
                } else {
                    item.classList.remove('show');
                }
            });
        });
    });
});
</script>
@endpush

@endsection
