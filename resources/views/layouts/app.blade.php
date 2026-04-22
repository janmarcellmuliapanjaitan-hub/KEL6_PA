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
    
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 76px;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }
        
        .navbar {
            background: #2c1810;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            color: white !important;
            font-weight: 700;
        }
        
        .nav-link {
            color: white !important;
            margin: 0 10px;
        }
        
        .nav-link.active {
            color: #c4a27a !important;
        }
        
        footer {
            background: #2c1810;
            color: white;
            padding: 30px 0;
            text-align: center;
        }

        .dropdown-menu {
            background-color: #2c1810;
            border: 1px solid rgba(196, 162, 122, 0.3);
        }
        
        .dropdown-item {
            color: white !important;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover, .dropdown-item:focus {
            background-color: #3b2416;
            color: #c4a27a !important;
        }
        
        .dropdown-item.active {
            background-color: #3b2416;
            color: #c4a27a !important;
            font-weight: 500;
        }

        @media all and (min-width: 992px) {
            .navbar .nav-item.dropdown:hover .dropdown-menu {
                display: block;
                margin-top: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-cup-hot-fill me-2"></i>
                Janji Martahan Coffee
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
    <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
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
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link btn btn-outline-light btn-sm px-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="min-width: 200px;">
                                <li><a class="dropdown-item" href="{{ route('guest.login.form') }}">
                                    <i class="bi bi-person me-2"></i>Login Pelanggan
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('guest.register.form') }}">
                                    <i class="bi bi-person-plus me-2"></i>Daftar Pelanggan
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('login') }}">
                                    <i class="bi bi-shield-lock me-2"></i>Login Admin
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
<footer style="background: #2c1810; color: white; padding: 30px 0 0;">
    @php
        $footerLocation = \App\Models\Location::first();
        $address = $footerLocation ? $footerLocation->address : 'Balige, Sumatera Utara, Indonesia';
        $mapQuery = $footerLocation && $footerLocation->latitude && $footerLocation->longitude 
            ? "{$footerLocation->latitude},{$footerLocation->longitude}" 
            : urlencode($address);
    @endphp
    <div class="container px-4 px-lg-3">
        <div class="row g-3 pb-3 justify-content-between">

            {{-- Kolom Kiri: Info Perusahaan --}}
            <div class="col-lg-6 col-md-12 text-start">
                <div class="mb-3">
                    <h5 style="font-family: 'Playfair Display', serif; font-size: 16px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px;">
                        <i class="bi bi-cup-hot-fill me-2" style="color: #c4a27a;"></i>Janji Martahan Coffee
                    </h5>
                    <div style="width: 40px; height: 2px; background: #c4a27a; margin-bottom: 10px;"></div>
                    <p style="font-size: 12px; color: #c4a27a; font-style: italic; margin-bottom: 0;">
                        "Menyajikan secangkir kehangatan dan kenyamanan untuk Anda."
                    </p>
                </div>

                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; align-items: flex-start; gap: 10px;">
                        <div style="width: 28px; height: 28px; border-radius: 50%; background: #3b2416; border: 1px solid #c4a27a; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="bi bi-geo-alt-fill" style="color: #c4a27a; font-size: 11px;"></i>
                        </div>
                        <div>
                            <p style="font-size: 10px; color: #888; margin: 0; text-transform: uppercase; letter-spacing: 0.06em;">Alamat</p>
                            <p style="font-size: 12px; color: #ddd; margin: 0;">{{ $address }}</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 10px;">
                        <div style="width: 28px; height: 28px; border-radius: 50%; background: #3b2416; border: 1px solid #c4a27a; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="bi bi-clock-fill" style="color: #c4a27a; font-size: 11px;"></i>
                        </div>
                        <div>
                            <p style="font-size: 10px; color: #888; margin: 0; text-transform: uppercase; letter-spacing: 0.06em;">Jam Operasional</p>
                            <p style="font-size: 12px; color: #ddd; margin: 0;">Senin – Minggu: 08.00 – 22.00</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 10px;">
                        <div style="width: 28px; height: 28px; border-radius: 50%; background: #3b2416; border: 1px solid #c4a27a; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="bi bi-telephone-fill" style="color: #c4a27a; font-size: 11px;"></i>
                        </div>
                        <div>
                            <p style="font-size: 10px; color: #888; margin: 0; text-transform: uppercase; letter-spacing: 0.06em;">Telepon</p>
                            <p style="font-size: 12px; color: #ddd; margin: 0;">083843802708</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 10px;">
                        <div style="width: 28px; height: 28px; border-radius: 50%; background: #3b2416; border: 1px solid #c4a27a; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="bi bi-envelope-fill" style="color: #c4a27a; font-size: 11px;"></i>
                        </div>
                        <div>
                            <p style="font-size: 10px; color: #888; margin: 0; text-transform: uppercase; letter-spacing: 0.06em;">Email</p>
                            <p style="font-size: 12px; color: #ddd; margin: 0;">janjimartahan@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Ikuti Kami --}}
            <div class="col-lg-5 col-md-12 text-start mt-3 mt-lg-0">
                <h6 style="font-size: 12px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 6px;">Ikuti Kami</h6>
                <div style="width: 30px; height: 2px; background: #c4a27a; margin-bottom: 10px;"></div>
                <p style="font-size: 12px; color: #bbb; margin-bottom: 10px; line-height: 1.5;">
                    Tetap terhubung dengan kami di media sosial untuk info promo dan update terbaru.
                </p>
                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                    <a href="https://www.instagram.com/janji.martahan/" style="width: 32px; height: 32px; border-radius: 50%; background: #3b2416; border: 1px solid #5a3a28; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s;"
                       onmouseover="this.style.background='#c4a27a'; this.style.borderColor='#c4a27a';"
                       onmouseout="this.style.background='#3b2416'; this.style.borderColor='#5a3a28';">
                        <i class="bi bi-instagram" style="color: #c4a27a; font-size: 13px;"></i>
                    </a>
                  
                    <a href="#" style="width: 32px; height: 32px; border-radius: 50%; background: #3b2416; border: 1px solid #5a3a28; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s;"
                       onmouseover="this.style.background='#c4a27a'; this.style.borderColor='#c4a27a';"
                       onmouseout="this.style.background='#3b2416'; this.style.borderColor='#5a3a28';">
                        <i class="bi bi-whatsapp" style="color: #c4a27a; font-size: 13px;"></i>
                    </a>
                </div>

                <div style="margin-top: 15px;">
                    <iframe src="https://maps.google.com/maps?q={{ $mapQuery }}&t=&z=17&ie=UTF8&iwloc=&output=embed" width="100%" height="120" frameborder="0" style="border:0; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.2);" allowfullscreen loading="lazy"></iframe>
                </div>

                {{-- Tagline Box --}}
                <div style="margin-top: 16px; padding: 10px 12px; border: 1px solid #4a3020; border-left: 3px solid #c4a27a; border-radius: 6px; background: #3b2010;">
                    <p style="font-size: 11px; color: #c4a27a; margin: 0; font-style: italic; line-height: 1.4;">
                        "Dari biji kopi terbaik Nusantara, kami hadirkan cita rasa yang tak terlupakan."
                    </p>
                </div>
            </div>

        </div>
    </div>

   {{-- Copyright Bar --}}
    <div style="background: #1e0f08; padding: 10px 0;">
        <div class="container px-4 px-lg-3">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <p style="font-size: 11px; color: #666; margin: 0;">
                        &copy; {{ date('Y') }} <span style="color: #c4a27a;">Janji Martahan Coffee</span>. 
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