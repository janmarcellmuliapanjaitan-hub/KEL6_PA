@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endpush

@section('content')
<div class="cart-container">
    <h2 class="cart-title">Keranjang Belanja</h2>

    @if(session('success'))
        <div class="cart-alert">
            {{ session('success') }}
        </div>
    @endif

    @if($carts->count() > 0)
        <div class="cart-wrapper">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th style="width: 40%">Menu</th>
                        <th style="width: 20%">Harga</th>
                        <th style="width: 15%; text-align: center;">Jumlah</th>
                        <th style="width: 15%">Subtotal</th>
                        <th style="width: 10%; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($carts as $cart)
                        @php 
                            $subtotal = $cart->menu->price * $cart->quantity;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <div class="cart-item-info">
                                    @if($cart->menu->image)
                                        <img src="{{ asset($cart->menu->image) }}" class="cart-item-img">
                                    @endif
                                    <div>
                                        <strong>{{ $cart->menu->name }}</strong><br>
                                        <span class="cart-item-cat">{{ $cart->menu->category }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>Rp {{ number_format($cart->menu->price, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('guest.cart.update', $cart->id) }}" method="POST" class="cart-qty-form">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" class="cart-qty-input">
                                    <button type="submit" class="cart-btn-update"><i class="fas fa-sync-alt"></i></button>
                                </form>
                            </td>
                            <td class="cart-subtotal">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            <td style="text-align: center;">
                                <form action="{{ route('guest.cart.remove', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cart-btn-delete" onclick="return confirm('Hapus item ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="cart-footer">
                <div>
                    <h3 class="cart-total-title">Total: <span class="cart-total-val">Rp {{ number_format($total, 0, ',', '.') }}</span></h3>
                </div>
                <div class="cart-actions">
                    <a href="{{ route('menu') }}" class="cart-btn-secondary">Lanjut Belanja</a>
                    <a href="{{ route('guest.checkout.index') }}" class="cart-btn-primary">Checkout <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    @else
        <div class="cart-empty-box">
            <i class="fas fa-shopping-cart cart-empty-icon"></i>
            <h4>Keranjang Anda masih kosong</h4>
            <p class="cart-empty-text">Silakan pilih menu favorit Anda terlebih dahulu.</p>
            <a href="{{ route('menu') }}" class="cart-btn-menu">Lihat Menu</a>
        </div>
    @endif
</div>
@endsection
