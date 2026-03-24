@extends('layouts.app')

@section('title', 'Checkout Pesanan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

@section('content')
<div class="checkout-container">
    <h2 class="checkout-title">Checkout Pesanan</h2>

    <div class="row">
        <div class="col-md-7">
            <div class="checkout-card">
                <h4 class="checkout-card-title">Detail Pengiriman</h4>
                
                <form action="{{ route('guest.checkout.process') }}" method="POST">
                    @csrf
                    <div class="checkout-form-group">
                        <label class="checkout-label">Nomor WhatsApp Anda</label>
                        <input type="text" name="whatsapp_number" class="checkout-input" placeholder="Cth: 08123456789" required>
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
                        <textarea name="address" id="address" class="checkout-input" rows="3" placeholder="Isi detail alamat jika delivery..."></textarea>
                    </div>

                    <div class="checkout-form-group">
                        <label class="checkout-label">Catatan Pesanan (Opsional)</label>
                        <textarea name="notes" class="checkout-input" rows="2" placeholder="Suhu, gula, atau pesan khusus..."></textarea>
                    </div>

                    <button type="submit" class="checkout-btn-submit">
                        <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
                    </button>
                </form>
            </div>
        </div>
        
        <div class="col-md-5">
            <div class="checkout-summary-card">
                <h4 class="checkout-summary-title">Ringkasan Belanja</h4>
                
                @foreach($carts as $cart)
                <div class="checkout-summary-item">
                    <div>{{ $cart->quantity }}x {{ $cart->menu->name }}</div>
                    <div>Rp {{ number_format($cart->menu->price * $cart->quantity, 0, ',', '.') }}</div>
                </div>
                @endforeach
                
                <div class="checkout-summary-divider"></div>
                
                <div class="checkout-total-row">
                    <div>Total</div>
                    <div>Rp {{ number_format($total, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleAddress() {
        var type = document.getElementById('delivery_type').value;
        var addrContainer = document.getElementById('address_container');
        var addrInput = document.getElementById('address');
        
        if (type === 'Delivery') {
            addrContainer.style.display = 'block';
            addrInput.setAttribute('required', 'required');
        } else {
            addrContainer.style.display = 'none';
            addrInput.removeAttribute('required');
        }
    }
</script>
@endsection
