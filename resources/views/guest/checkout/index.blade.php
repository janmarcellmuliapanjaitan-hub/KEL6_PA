@extends('layouts.app')

@section('title', 'Checkout Pesanan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

@section('content')
<div class="checkout-container">
    <div class="checkout-header">
        <p class="lbl">Selesaikan Pesanan</p>
        <h2 class="checkout-title">Ringkasan <em>Checkout</em></h2>
    </div>

    <div class="checkout-row">
        <div class="checkout-col-form">
            <div class="checkout-card">
                <h4 class="checkout-card-title">Detail Pengiriman</h4>
                
                <form action="{{ route('guest.checkout.process') }}" method="POST">
                    @csrf
                    <div class="checkout-form-group">
                        <label class="checkout-label">Nomor WhatsApp Anda</label>
                        <input type="text" name="whatsapp_number" class="checkout-input @error('whatsapp_number') is-invalid @enderror" placeholder="Cth: 08123456789" pattern="[0-9]*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('whatsapp_number') }}" required>
                        @error('whatsapp_number')
                            <span class="text-danger" style="font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="checkout-form-group">
                        <label class="checkout-label">Tipe Pengambilan</label>
                        <select name="delivery_type" id="delivery_type" class="checkout-input" required onchange="toggleAddress()">
                            <option value="Take Away">Take Away (Ambil di tempat)</option>
                            <option value="Delivery">Delivery (Diantar)</option>
                        </select>
                    </div>

                    <div class="checkout-form-group" id="address_container" style="display: none;">
                        <label class="checkout-label">Alamat Lengkap Pengiriman</label>
                        <textarea name="address" id="address" class="checkout-input" rows="3" placeholder="Isi detail alamat jika pesanan diantar..."></textarea>
                    </div>

                    <div class="checkout-form-group">
                        <label class="checkout-label">Catatan Pesanan (Opsional)</label>
                        <textarea name="notes" class="checkout-input" rows="2" placeholder="Suhu, gula, atau pesan khusus..."></textarea>
                    </div>

                    <button type="submit" class="checkout-btn-submit">
                        <i class="fab fa-whatsapp"></i> Pesan Sekarang via WhatsApp
                    </button>
                </form>
            </div>
        </div>
        
        <div class="checkout-col-summary">
            <div class="checkout-summary-card">
                <h4 class="checkout-summary-title">Pesanan Anda</h4>
                
                @foreach($carts as $cart)
                <div class="checkout-summary-item">
                    <span>{{ $cart->quantity }}x {{ $cart->menu->name }}</span>
                    <span>Rp {{ number_format($cart->menu->price * $cart->quantity, 0, ',', '.') }}</span>
                </div>
                @endforeach
                
                <div class="checkout-summary-divider"></div>
                
                <div class="checkout-total-row">
                    <span>Total</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/checkout.js') }}"></script>
@endpush
@endsection
