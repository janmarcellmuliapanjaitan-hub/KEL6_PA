@extends('layouts.app')

@section('title', 'Memproses Pesanan - Janji Martahan Coffee')

@section('content')
<div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 60vh; text-align: center; padding-top: 100px;">
    <div class="spinner-border text-warning mb-4" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
    
    <h3 style="color: #e8c98a; font-family: 'Playfair Display', serif; font-weight: 700;">Pesanan Berhasil Dibuat!</h3>
    <p style="color: #f5e6d3; font-size: 1.1rem; max-width: 500px; margin: 0 auto 20px;">
        Anda sedang dialihkan ke WhatsApp untuk melanjutkan pesanan Anda ke Admin.
    </p>
    
    <p style="color: #c4a27a; font-size: 0.9rem;">
        Jika tidak dialihkan secara otomatis, silakan <a href="{{ $waUrl }}" id="manualWaLink" style="color: #e8c98a; font-weight: bold; text-decoration: underline;">klik di sini</a>.
    </p>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Use sessionStorage to detect if the user has already been redirected
        if (!sessionStorage.getItem('wa_redirected')) {
            sessionStorage.setItem('wa_redirected', 'true');
            // Redirect to WA immediately
            window.location.href = "{!! $waUrl !!}";
        } else {
            // User came back from WA, redirect to home and clear the flag
            sessionStorage.removeItem('wa_redirected');
            window.location.replace("{{ route('home') }}");
        }
        
        // Listen to pageshow event for bfcache (back-forward cache handling)
        window.addEventListener('pageshow', function(event) {
            if (event.persisted && sessionStorage.getItem('wa_redirected')) {
                sessionStorage.removeItem('wa_redirected');
                window.location.replace("{{ route('home') }}");
            }
        });
        
        // Fallback: If document becomes visible again (e.g., user returns to this tab from WhatsApp app)
        document.addEventListener("visibilitychange", function() {
            if (document.visibilityState === 'visible' && sessionStorage.getItem('wa_redirected')) {
                sessionStorage.removeItem('wa_redirected');
                window.location.replace("{{ route('home') }}");
            }
        });
    });
</script>
@endpush
@endsection
