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


                <div class="menu-grid">
                    @forelse($menus as $category => $items)
                        @foreach($items as $menu)
                            <div class="menu-item show" data-category="{{ $menu->category }}">
                                <div class="menu-card {{ $menu->is_available ? '' : 'unavailable' }}"
                                     data-id="{{ $menu->id }}"
                                     data-name="{{ $menu->name }}"
                                     data-category="{{ $menu->category }}"
                                     data-description="{{ $menu->description }}"
                                     data-price="Rp {{ number_format($menu->price, 0, ',', '.') }}"
                                     data-raw-price="{{ $menu->price }}"
                                     data-image="{{ $menu->image ? asset($menu->image) : '' }}"
                                     data-available="{{ $menu->is_available ? 'true' : 'false' }}"
                                     data-action="{{ route('guest.cart.add', $menu->id) }}">
                                    @if(!$menu->is_available)
                                        <div class="menu-badge-unavailable">Tidak Tersedia</div>
                                    @endif
                                    @if($menu->image)
                                        <img src="{{ asset($menu->image) }}" class="menu-img" alt="{{ $menu->name }}" onclick="showMenuDetail(this.closest('.menu-card'))" style="cursor: pointer;">
                                    @else
                                        <div class="menu-img-empty" onclick="showMenuDetail(this.closest('.menu-card'))" style="cursor: pointer;">Tanpa Gambar</div>
                                    @endif
                                    <h3 class="menu-title">{{ $menu->name }}</h3>
                                    <p class="menu-desc">{{ Str::limit($menu->description, 60) }}</p>
                                    <div class="menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>

                                    <div class="menu-order-section" onclick="event.stopPropagation()">
                                        @if($menu->is_available)
                                            <!-- Quantity Selector -->
                                            <div class="card-qty-selector">
                                                <button type="button" class="card-qty-btn" onclick="changeCardQty(this, -1)">-</button>
                                                <input type="number" class="card-qty-input" value="1" min="1" readonly>
                                                <button type="button" class="card-qty-btn" onclick="changeCardQty(this, 1)">+</button>
                                            </div>
                                            
                                            <!-- Total Price Display -->
                                            <div class="card-qty-total" data-base-price="{{ $menu->price }}">
                                                Total: <span class="card-qty-total-val">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="card-action-buttons">
                                                @auth
                                                    <button type="button" class="btn-add-ajax-card" onclick="addToCartAjax({{ $menu->id }}, this)" title="Masukkan ke Keranjang">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </button>
                                                    <button type="button" class="btn-order-direct-card" onclick="orderDirect({{ $menu->id }}, this)">
                                                        Pesan
                                                    </button>
                                                @else
                                                    <button type="button" class="btn-add-ajax-card" onclick="guestAlert()" title="Masukkan ke Keranjang">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </button>
                                                    <button type="button" class="btn-order-direct-card" onclick="guestAlert()">
                                                        Pesan
                                                    </button>
                                                @endauth
                                            </div>
                                        @else
                                            <div class="text-danger font-weight-bold py-2 mb-2" style="font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.05em;">
                                                <i class="fas fa-times-circle"></i> Tidak Tersedia
                                            </div>
                                        @endif
                                    </div>
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
                            <div id="detail-available-section">
                                @auth
                                    <div class="detail-qty-wrapper">
                                        <label for="detail-qty">Jumlah:</label>
                                        <div class="detail-qty-controls">
                                            <button type="button" class="qty-btn" onclick="decreaseDetailQty()"><i class="fas fa-minus"></i></button>
                                            <input type="number" name="quantity" id="detail-qty" value="1" min="1" class="qty-input" readonly>
                                            <button type="button" class="qty-btn" onclick="increaseDetailQty()"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    
                                    <!-- Total Price Display -->
                                    <div class="card-qty-total mb-3 text-end" id="detail-qty-total-box" style="font-size: 0.95rem; margin-top: -10px;">
                                        Total: <span id="detail-qty-total-val" class="card-qty-total-val" style="font-size: 1.1rem;">Rp 0</span>
                                    </div>

                                    <div class="card-action-buttons">
                                        <button type="button" class="btn-add-ajax-card" onclick="addSidebarToCartAjax()" title="Masukkan ke Keranjang" style="height: 46px; width: 50px; border-radius: 8px;">
                                            <i class="fas fa-shopping-cart" style="font-size: 1.2rem;"></i>
                                        </button>
                                        <button type="button" class="btn-order-direct-card" onclick="orderSidebarDirect()" style="height: 46px; border-radius: 8px; font-size: 1rem;">
                                            Pesan
                                        </button>
                                    </div>
                                @else
                                    <div class="card-action-buttons">
                                        <button type="button" class="btn-add-ajax-card" onclick="guestAlert()" title="Masukkan ke Keranjang" style="height: 46px; width: 50px; border-radius: 8px;">
                                            <i class="fas fa-shopping-cart" style="font-size: 1.2rem;"></i>
                                        </button>
                                        <button type="button" class="btn-order-direct-card" onclick="guestAlert()" style="height: 46px; border-radius: 8px; font-size: 1rem;">
                                            Pesan
                                        </button>
                                    </div>
                                @endauth
                            </div>

                            <div id="detail-unavailable-section" style="display: none;">
                                <div class="text-danger text-center font-weight-bold py-3" style="font-size: 1.1rem; border: 1px dashed rgba(220, 53, 69, 0.3); border-radius: 8px; background: rgba(220, 53, 69, 0.05);">
                                    <i class="fas fa-times-circle mr-1"></i> Menu ini sedang tidak tersedia
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            window.menuConfig = {
                registerUrl: "{{ route('guest.register.form') }}",
                cartUrl: "{{ route('guest.cart.index') }}",
                csrfToken: "{{ csrf_token() }}"
            };
        </script>
        <script src="{{ asset('js/menu.js') }}"></script>
    @endpush

@endsection