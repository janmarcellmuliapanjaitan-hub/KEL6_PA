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
                <a href="{{ route('guest.register.form') }}"
                    onclick="alert('Silakan daftar menjadi pelanggan terlebih dahulu untuk melihat keranjang.')">
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

        <div class="menu-layout-wrapper">
            <div class="menu-left-content">
                @if(session('success'))
                    <div class="menu-alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="menu-grid">
                    @forelse($menus as $category => $items)
                        @foreach($items as $menu)
                            <div class="menu-item show" data-category="{{ $menu->category }}">
                                <div class="menu-card"
                                     data-id="{{ $menu->id }}"
                                     data-name="{{ $menu->name }}"
                                     data-category="{{ $menu->category }}"
                                     data-description="{{ $menu->description }}"
                                     data-price="Rp {{ number_format($menu->price, 0, ',', '.') }}"
                                     data-image="{{ $menu->image ? asset($menu->image) : '' }}"
                                     data-action="{{ route('guest.cart.add', $menu->id) }}">
                                    @if($menu->image)
                                        <img src="{{ asset($menu->image) }}" class="menu-img" alt="{{ $menu->name }}" onclick="showMenuDetail(this.closest('.menu-card'))" style="cursor: pointer;">
                                    @else
                                        <div class="menu-img-empty" onclick="showMenuDetail(this.closest('.menu-card'))" style="cursor: pointer;">Tanpa Gambar</div>
                                    @endif
                                    <h3 class="menu-title">{{ $menu->name }}</h3>
                                    <p class="menu-desc">{{ Str::limit($menu->description, 60) }}</p>
                                    <div class="menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>

                                    @auth
                                        <form action="{{ route('guest.cart.add', $menu->id) }}" method="POST" onclick="event.stopPropagation()">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn-add-cart">
                                                <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('guest.register.form') }}" class="btn-add-cart"
                                            onclick="event.stopPropagation(); alert('Silakan daftar menjadi pelanggan terlebih dahulu untuk melakukan pemesanan.')">
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

            <div class="menu-right-sidebar">
                <!-- Dynamic Menu Detail Content (hidden initially by width: 0) -->
                <div id="menu-detail-content" class="menu-detail-card">
                    <button type="button" id="close-detail-btn" class="close-detail-btn"><i class="fas fa-arrow-left"></i></button>
                    <img id="detail-img" src="" class="detail-img" alt="" style="display: none;">
                    <div id="detail-img-empty" class="detail-img-empty" style="display: none;">Tanpa Gambar</div>
                    
                    <div class="detail-body">
                        <span id="detail-category" class="detail-category">Kategori</span>
                        <h3 id="detail-title" class="detail-title">Nama Menu</h3>
                        <p id="detail-desc" class="detail-desc">Deskripsi lengkap menu...</p>
                        <div id="detail-price" class="detail-price">Rp 0</div>
                        
                        <div class="detail-action-box">
                            @auth
                                <form id="detail-add-form" action="" method="POST">
                                    @csrf
                                    <div class="detail-qty-wrapper">
                                        <label for="detail-qty">Jumlah:</label>
                                        <div class="detail-qty-controls">
                                            <button type="button" class="qty-btn" onclick="decreaseDetailQty()"><i class="fas fa-minus"></i></button>
                                            <input type="number" name="quantity" id="detail-qty" value="1" min="1" class="qty-input">
                                            <button type="button" class="qty-btn" onclick="increaseDetailQty()"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-add-cart-detail">
                                        <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('guest.register.form') }}" class="btn-add-cart-detail" onclick="alert('Silakan daftar menjadi pelanggan terlebih dahulu untuk melakukan pemesanan.')">
                                    <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const filterBtns = document.querySelectorAll('.filter-btn');
                const menuItems = document.querySelectorAll('.menu-item');

                filterBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        filterBtns.forEach(b => b.classList.remove('active'));
                        btn.classList.add('active');

                        const filterValue = btn.getAttribute('data-filter');

                        menuItems.forEach(item => {
                            if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                                item.classList.add('show');
                            } else {
                                item.classList.remove('show');
                            }
                        });
                    });
                });

                // Close detail btn click listener
                const closeBtn = document.getElementById('close-detail-btn');
                if (closeBtn) {
                    closeBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        document.querySelectorAll('.menu-card').forEach(c => c.classList.remove('active-card'));
                        document.querySelector('.menu-container').classList.remove('has-active-detail');
                    });
                }

                // Hide browser defaults for number input scrolling
                document.querySelectorAll('.qty-input').forEach(function(input) {
                    input.addEventListener('wheel', function(e) {
                        e.preventDefault();
                    });
                });
            });

            function showMenuDetail(cardElement) {
                // Extract data
                const id = cardElement.getAttribute('data-id');
                const name = cardElement.getAttribute('data-name');
                const category = cardElement.getAttribute('data-category');
                const description = cardElement.getAttribute('data-description');
                const price = cardElement.getAttribute('data-price');
                const image = cardElement.getAttribute('data-image');
                const action = cardElement.getAttribute('data-action');
                
                // Populate sidebar details
                const detailImg = document.getElementById('detail-img');
                const detailImgEmpty = document.getElementById('detail-img-empty');
                
                if (image) {
                    detailImg.src = image;
                    detailImg.alt = name;
                    detailImg.style.display = 'block';
                    detailImgEmpty.style.display = 'none';
                } else {
                    detailImg.style.display = 'none';
                    detailImgEmpty.style.display = 'flex';
                }
                
                document.getElementById('detail-category').textContent = category;
                document.getElementById('detail-title').textContent = name;
                document.getElementById('detail-desc').textContent = description;
                document.getElementById('detail-price').textContent = price;
                
                // Set quantity back to 1
                const qtyInput = document.getElementById('detail-qty');
                if (qtyInput) qtyInput.value = 1;
                
                // Set form action URL
                const addForm = document.getElementById('detail-add-form');
                if (addForm) {
                    addForm.action = action;
                }
                
                // Expand sidebar layout by adding class
                document.querySelector('.menu-container').classList.add('has-active-detail');
                
                // Highlight active card
                document.querySelectorAll('.menu-card').forEach(c => c.classList.remove('active-card'));
                cardElement.classList.add('active-card');
                
                // Scroll to details on mobile/tablet view
                if (window.innerWidth <= 1024) {
                    const contentCard = document.getElementById('menu-detail-content');
                    contentCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }

            function decreaseDetailQty() {
                let input = document.getElementById('detail-qty');
                let val = parseInt(input.value);
                if (val > 1) {
                    input.value = val - 1;
                }
            }

            function increaseDetailQty() {
                let input = document.getElementById('detail-qty');
                let val = parseInt(input.value);
                input.value = val + 1;
            }
        </script>
    @endpush

@endsection