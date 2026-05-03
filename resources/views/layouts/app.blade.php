<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Janji Martahan Coffee')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    
    @stack('styles')
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid px-4 px-lg-5 justify-content-center">
            <!-- Brand untuk Mobile -->
            <a class="navbar-brand d-lg-none" href="{{ route('home') }}">
               <img src="{{ asset('image/logo.png') }}" alt="Logo" height="30" class="me-2">
                Janji Martahan Coffee
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <!-- Brand untuk Desktop (berada di tengah bersanding dengan menu) -->
                <a class="navbar-brand d-none d-lg-block me-5 pe-lg-5" href="{{ route('home') }}">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" height="40" class="me-2">
                    Janji Martahan Coffee
                </a>
                
                <ul class="navbar-nav ms-lg-5">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('about') || request()->routeIs('contacts') ? 'active' : '' }}" href="{{ route('about') }}" onclick="if(window.innerWidth > 991){ window.location.href=this.href; return false; }" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About Us
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang Kami</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('contacts') ? 'active' : '' }}" href="{{ route('contacts') }}">Hubungi Kami</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('menu') || request()->routeIs('promo') ? 'active' : '' }}" href="{{ route('menu') }}" onclick="if(window.innerWidth > 991){ window.location.href=this.href; return false; }" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ request()->routeIs('menu') ? 'active' : '' }}" href="{{ route('menu') }}">Daftar Menu</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('promo') ? 'active' : '' }}" href="{{ route('promo') }}">Promo</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('testimoni') ? 'active' : '' }}" href="{{ route('testimoni') }}">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a>
                    </li>

                    <!-- Login/Admin Area -->
                    @auth
                        @if(Auth::user()->role === 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-nav').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                    <form id="logout-form-nav" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @else
                        @php
                            $recentOrders = \App\Models\Order::where('user_id', Auth::id())
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();
                        @endphp
                        <li class="nav-item dropdown me-2">
                            <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell-fill fs-5" style="color: #2b1a10;"></i>
                                @if($recentOrders->count() > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="margin-top: 10px; margin-left: -15px;">
                                        <span class="visually-hidden">New alerts</span>
                                    </span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" style="min-width: 260px; background-color: #1a0f08; border: 1px solid rgba(232,201,138,0.3); border-radius: 8px;">
                                <li><h6 class="dropdown-header text-uppercase" style="color: #e8c98a; font-weight: 700; letter-spacing: 0.05em; font-size: 0.8rem;">Notifikasi Pesanan</h6></li>
                                <li><hr class="dropdown-divider" style="border-color: rgba(232,201,138,0.2);"></li>
                                @forelse($recentOrders as $order)
                                    <li>
                                        <a class="dropdown-item py-2" href="#" style="background-color: transparent; transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='#2b1a10'" onmouseout="this.style.backgroundColor='transparent'">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    @if($order->status == 'pending')
                                                        <i class="bi bi-hourglass-split fs-4" style="color: #ffc107;"></i>
                                                    @elseif($order->status == 'completed')
                                                        <i class="bi bi-check-circle-fill fs-4" style="color: #e8c98a;"></i>
                                                    @else
                                                        <i class="bi bi-x-circle-fill fs-4" style="color: #dc3545;"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h6 class="mb-0" style="font-size: 0.9rem; color: #f5e6d3;">Pesanan #{{ $order->order_number }}</h6>
                                                    <small style="font-size: 0.8rem; color: #c4a27a;">
                                                        @if($order->status == 'pending')
                                                            Sedang diproses
                                                        @elseif($order->status == 'completed')
                                                            Selesai diproses
                                                        @else
                                                            Dibatalkan
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @if(!$loop->last)
                                        <li><hr class="dropdown-divider" style="border-color: rgba(232,201,138,0.2);"></li>
                                    @endif
                                @empty
                                    <li><span class="dropdown-item text-center py-3" style="color: #c4a27a; font-size: 0.9rem;">Tidak ada notifikasi</span></li>
                                @endforelse
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-nav').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                    <form id="logout-form-nav" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="min-width: 200px;">
                                <li><a class="dropdown-item" href="{{ route('guest.login.form') }}">
                                    <i class="bi bi-person me-2"></i>Masuk / Login
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('guest.register.form') }}">
                                    <i class="bi bi-person-plus me-2"></i>Daftar Akun
                                </a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <footer style="background: #1a0f08; color: white; padding: 30px 0 0;">
        @php
            $footerLocation = \App\Models\Location::first();
            $address = $footerLocation ? $footerLocation->address : 'Balige, Sumatera Utara, Indonesia';
            $mapQuery = $footerLocation && $footerLocation->latitude && $footerLocation->longitude 
                ? "{$footerLocation->latitude},{$footerLocation->longitude}" 
                : urlencode($address);
        @endphp
        <div class="container px-4 px-lg-3">
            <div class="row g-3 pb-3 justify-content-between ms-lg-5 ps-lg-5">

                {{-- Kolom Kiri: Ikuti Kami --}}
                <div class="col-lg-5 col-md-12 text-start">
                    <h6 style="font-size: 12px; font-weight: 700; color: #f5e6d3; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 6px;">Ikuti Kami</h6>
                    <div style="width: 30px; height: 2px; background: #e8c98a; margin-bottom: 10px;"></div>
                    <p style="font-size: 12px; color: #c4a27a; margin-bottom: 10px; line-height: 1.5;">
                        Tetap terhubung dengan kami di media sosial untuk info promo dan update terbaru.
                    </p>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <a href="https://www.instagram.com/janji.martahan/" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: #f5e6d3; transition: all 0.2s;" onmouseover="this.style.color='#e8c98a';" onmouseout="this.style.color='#f5e6d3';">
                            <div style="width: 32px; height: 32px; border-radius: 50%; background: #2b1a10; border: 1px solid rgba(232,201,138,0.4); display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-instagram" style="color: #e8c98a; font-size: 13px;"></i>
                            </div>
                            <span style="font-size: 13px; font-weight: 500;">Instagram</span>
                        </a>
                      
                        <a href="#" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: #f5e6d3; transition: all 0.2s;" onmouseover="this.style.color='#e8c98a';" onmouseout="this.style.color='#f5e6d3';">
                            <div style="width: 32px; height: 32px; border-radius: 50%; background: #2b1a10; border: 1px solid rgba(232,201,138,0.4); display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-whatsapp" style="color: #e8c98a; font-size: 13px;"></i>
                            </div>
                            <span style="font-size: 13px; font-weight: 500;">WhatsApp</span>
                        </a>

                        <a href="#" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: #f5e6d3; transition: all 0.2s;" onmouseover="this.style.color='#e8c98a';" onmouseout="this.style.color='#f5e6d3';">
                            <div style="width: 32px; height: 32px; border-radius: 50%; background: #2b1a10; border: 1px solid rgba(232,201,138,0.4); display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-tiktok" style="color: #e8c98a; font-size: 13px;"></i>
                            </div>
                            <span style="font-size: 13px; font-weight: 500;">TikTok</span>
                        </a>
                    </div>

                    {{-- Tagline Box --}}
                    <div style="margin-top: 16px; padding: 10px 12px; border: 1px solid rgba(232,201,138,0.2); border-left: 3px solid #e8c98a; border-radius: 6px; background: #2b1a10;">
                        <p style="font-size: 11px; color: #e8c98a; margin: 0; font-style: italic; line-height: 1.4;">
                            "Dari biji kopi terbaik Nusantara, kami hadirkan cita rasa yang tak terlupakan."
                        </p>
                    </div>
                </div>

                {{-- Kolom Kanan: Info Perusahaan --}}
                <div class="col-lg-6 col-md-12 text-start mt-4 mt-lg-0">
                    <div class="mb-3">
                        <h5 style="font-family: 'Playfair Display', serif; font-size: 16px; font-weight: 700; color: #f5e6d3; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px;">
                            <i class="bi bi-cup-hot-fill me-2" style="color: #e8c98a;"></i>Janji Martahan Coffee
                        </h5>
                        <div style="width: 40px; height: 2px; background: #e8c98a; margin-bottom: 10px;"></div>
                        <p style="font-size: 12px; color: #e8c98a; font-style: italic; margin-bottom: 0;">
                            "Menyajikan secangkir kehangatan dan kenyamanan untuk Anda."
                        </p>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <div style="display: flex; align-items: flex-start; gap: 10px;">
                            <div style="width: 28px; height: 28px; border-radius: 50%; background: #2b1a10; border: 1px solid #e8c98a; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-geo-alt-fill" style="color: #e8c98a; font-size: 11px;"></i>
                            </div>
                            <div style="flex-grow: 1;">
                                <p style="font-size: 10px; color: #c4a27a; margin: 0; text-transform: uppercase; letter-spacing: 0.06em;">Alamat</p>
                                <p style="font-size: 12px; color: #f5e6d3; margin: 0; margin-bottom: 8px;">{{ $address }}</p>
                                <iframe src="https://maps.google.com/maps?q={{ $mapQuery }}&t=&z=17&ie=UTF8&iwloc=&output=embed" width="85%" height="135" frameborder="0" style="border:0; border-radius: 5px; box-shadow: 0 2px 8px rgba(0,0,0,0.4);" allowfullscreen loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Copyright Bar --}}
        <div style="background: #140b05; padding: 10px 0; border-top: 1px solid rgba(232, 201, 138, 0.1);">
            <div class="container px-4 px-lg-3">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
                        <p style="font-size: 11px; color: #7a5c3e; margin: 0;">
                            &copy; {{ date('Y') }} <span style="color: #e8c98a;">Janji Martahan Coffee</span>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>