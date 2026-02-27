@extends('layouts.app')

@section('title', 'Beranda')

@push('styles')
 
<style>
    /* Hero Section */
    .hero-section {
        height: 100vh;
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                    url('https://images.unsplash.com/photo-1554118811-1e0d58224f24?ixlib=rb-4.0.3&auto=format&fit=crop&w=2047&q=80');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        margin-top: -76px;
    }
    
    .hero-title {
        color: white;
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .hero-subtitle {
        color: #c4a27a;
        font-size: 1.2rem;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    
    .section {
        padding: 60px 0;
    }
    
    .section-title {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 40px;
        text-align: center;
        position: relative;
    }
    
    .section-title:after {
        content: '';
        display: block;
        width: 50px;
        height: 3px;
        background: #c4a27a;
        margin: 10px auto 0;
    }
    
    .about-img {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .testimoni-card {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .testimoni-img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
    }
    
    .rating {
        color: #ffc107;
        margin: 10px 0;
    }
    
    .info-box {
        background: #c4a27a;
        color: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        height: 100%;
    }
    
    .info-box i {
        font-size: 2rem;
        margin-bottom: 10px;
    }
    
    .jam-operasional {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-top: 30px;
    }
    
    .jam-item {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px dashed #ddd;
    }
    
    .jam-item:last-child {
        border-bottom: none;
    }
    
    .btn-custom {
        background: #c4a27a;
        color: white;
        padding: 10px 25px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-custom:hover {
        background: #a8865e;
        color: white;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="hero-subtitle">Janji Martahan Coffee</div>
                    <h1 class="hero-title">Temukan Kenikmatan<br>Keasrian Alam</h1>
                    <div class="mt-4">
                        
                       
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Cafe (Cuplikan) -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Tentang Kami</h2>
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="https://images.unsplash.com/photo-1559925393-8be0ec4767c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80" 
                         alt="Tentang Cafe" class="about-img">
                </div>
                <div class="col-md-6">
                    <h3>Janji Martahan Coffee Balige</h3>
                    <p class="text-muted">Didirikan tahun 2020, kami hadir sebagai tempat nongkrong favorit di Balige dengan konsep cozy dan pemandangan alam yang indah.</p>
                    <p class="text-muted">Menyajikan kopi pilihan dari petani lokal Sumatera Utara dengan cita rasa khas yang memanjakan lidah.</p>
                    
                        Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Terbaru -->
    <section class="section bg-light">
        <div class="container">
            <h2 class="section-title">Testimoni Pelanggan</h2>
            <div class="row">
                <!-- Testimoni 1 -->
                <div class="col-md-4 mb-4">
                    <div class="testimoni-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Customer" class="testimoni-img">
                            <div>
                                <h5 class="mb-0">Budi Santoso</h5>
                                <small class="text-muted">Pengunjung</small>
                            </div>
                        </div>
                        <div class="rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="mb-0">"Tempatnya nyaman, kopinya enak, viewnya bagus. Cocok buat santai sama teman-teman."</p>
                    </div>
                </div>
                
                <!-- Testimoni 2 -->
                <div class="col-md-4 mb-4">
                    <div class="testimoni-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Customer" class="testimoni-img">
                            <div>
                                <h5 class="mb-0">Siti Aminah</h5>
                                <small class="text-muted">Pengunjung</small>
                            </div>
                        </div>
                        <div class="rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="mb-0">"Pelayanan ramah, harga terjangkau, nasi gorengnya enak banget! Pasti balik lagi."</p>
                    </div>
                </div>
                
                <!-- Testimoni 3 -->
                <div class="col-md-4 mb-4">
                    <div class="testimoni-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Customer" class="testimoni-img">
                            <div>
                                <h5 class="mb-0">Ahmad Rizki</h5>
                                <small class="text-muted">Pengunjung</small>
                            </div>
                        </div>
                        <div class="rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <p class="mb-0">"Kopi Bataknya mantap, suasananya adem cocok buat nongkrong sambil kerja."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lokasi dan Kontak Ringkas + Jam Operasional -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Lokasi & Kontak</h2>
            <div class="row">
                <!-- Lokasi -->
                <div class="col-md-6 mb-4">
                    <div class="info-box">
                        <i class="bi bi-geo-alt-fill"></i>
                        <h4>Lokasi Kami</h4>
                        <p>Jl. Sisingamangaraja No. 123, Balige<br>Sumatera Utara</p>
                        <div class="mt-3">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d255281.1904021647!2d98.93868025136718!3d2.330405312315595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e00b82e8e2e5b%3A0xc03e5b7e9b9e9b9e!2sBalige%2C%20Toba%20Samosir%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1621234567890!5m2!1sid!2sid" 
                                width="100%" 
                                height="200" 
                                style="border:0; border-radius: 10px;" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
                
                <!-- Kontak Ringkas -->
                <div class="col-md-6 mb-4">
                    <div class="info-box">
                        <i class="bi bi-telephone-fill"></i>
                        <h4>Hubungi Kami</h4>
                        <div class="mt-4">
                            <p class="mb-2">
                                <i class="bi bi-whatsapp me-2"></i>
                                <a href="https://wa.me/6281234567890" class="text-white">+62 812-3456-7890</a>
                            </p>
                            <p class="mb-2">
                                <i class="bi bi-instagram me-2"></i>
                                <a href="https://instagram.com/janjimartahancoffee" class="text-white">@janjimartahancoffee</a>
                            </p>
                            <p class="mb-2">
                                <i class="bi bi-envelope-fill me-2"></i>
                                <a href="mailto:info@janjimartahan.com" class="text-white">info@janjimartahan.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jam Operasional -->
            <div class="jam-operasional">
                <h4 class="mb-4 text-center">Jam Operasional</h4>
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="jam-item">
                            <span>Senin - Jumat</span>
                            <span><strong>08.00 - 22.00</strong></span>
                        </div>
                        <div class="jam-item">
                            <span>Sabtu</span>
                            <span><strong>09.00 - 23.00</strong></span>
                        </div>
                        <div class="jam-item">
                            <span>Minggu</span>
                            <span><strong>09.00 - 22.00</strong></span>
                        </div>
                        <div class="jam-item">
                            <span>Hari Libur Nasional</span>
                            <span><strong>09.00 - 22.00</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Simple script untuk navbar scroll (opsional)
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
@endpush