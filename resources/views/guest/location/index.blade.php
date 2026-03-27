@extends('layouts.app')

@push('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        .map-wrapper {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 40px;
        }
        #map {
            height: 500px;
            width: 100%;
            border-radius: 8px;
            z-index: 1; /* Prevent map from overlapping dropdowns/navbars */
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset("images/hero-bg.jpg") }}') center/cover;
            color: white;
            padding: 80px 0;
            margin-bottom: 40px;
        }
    </style>
@endpush

@section('content')

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Lokasi Kami</h1>
            <p class="lead">Temukan Janji Martahan Coffee dari lokasi Anda.</p>
        </div>
    </section>

    <!-- Map Section -->
    <div class="container">
        
        <div class="row mb-5">
            <div class="col-12 text-center mb-4">
                <h2 class="fw-bold section-title">Peta Lokasi</h2>
                <div class="divider mx-auto"></div>
            </div>

            <div class="col-12">
                <div class="map-wrapper">
                    <!-- Leaflet JS Map Container -->
                    <div id="map"></div>
                </div>

                <!-- Locations List Fallback / Info -->
                <div class="row g-4 mt-2">
                    @forelse($locations as $loc)
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold text-primary"><i class="bi bi-geo-alt-fill"></i> {{ $loc->name }}</h5>
                                    <p class="card-text text-muted mb-0 mt-2">{{ $loc->address ?? 'Alamat tidak tersedia' }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted">
                            <p>Lokasi cabang belum tersedia saat ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Inisialisasi map, default center Indonesia
            var map = L.map('map').setView([-0.789275, 113.921327], 5);

            // Set provider peta menggunakan OpenStreetMap
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Mengambil data lokasi dari database yang dilempar oleh controller
            var locations = @json($locations);
            var bounds = [];

            if(locations.length > 0) {
                
                // Menambahkan penanda (marker) untuk setiap lokasi
                locations.forEach(function(loc) {
                    var lat = parseFloat(loc.latitude);
                    var lng = parseFloat(loc.longitude);
                    
                    if(!isNaN(lat) && !isNaN(lng)) {
                        var marker = L.marker([lat, lng]).addTo(map);
                        
                        // Isi popup
                        var popupContent = '<b>' + loc.name + '</b>';
                        if(loc.address) {
                            popupContent += '<br>' + loc.address;
                        }
                        popupContent += '<br><a href="https://www.google.com/maps/dir/?api=1&destination=' + lat + ',' + lng + '" target="_blank" class="btn btn-sm btn-primary mt-2 py-1 px-2" style="font-size: 12px;">Rute (Google Maps)</a>';
                        
                        marker.bindPopup(popupContent);
                        
                        // Menambahkan titik ke array bounds
                        bounds.push([lat, lng]);
                    }
                });

                // Sesuaikan zoom dan tengah map agar semua penanda terlihat
                if(bounds.length > 0) {
                    map.fitBounds(bounds, {padding: [50, 50], maxZoom: 16});
                }
            } else {
                // Default ke Samarinda jika tidak ada data sama sekali tapi map diload
                map.setView([-0.502106, 117.153709], 13);
            }

        });
    </script>
@endpush
