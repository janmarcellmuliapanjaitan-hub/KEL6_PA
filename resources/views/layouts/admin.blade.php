<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Admin') - Janji Martahan Coffee</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    @stack('styles')
    
    <style>
        body {
            font-size: .875rem;
            background: #f8f9fa;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background: #2c1810;
            width: 250px;
        }
        
        .sidebar .nav-link {
            font-weight: 500;
            color: rgba(255,255,255,.8);
            padding: 12px 20px;
            margin: 2px 10px;
            border-radius: 5px;
        }
        
        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255,255,255,.1);
        }
        
        .sidebar .nav-link.active {
            color: white;
            background: #c4a27a;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        
        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        /* Navbar admin */
        .navbar-admin {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,.1);
            padding: 15px 20px;
            margin-bottom: 30px;
            border-radius: 5px;
        }
        
        /* Cards */
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,.1);
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            color: #c4a27a;
        }
        
        /* Tables */
        .table-admin {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,.1);
        }
        
        .table-admin thead {
            background: #2c1810;
            color: white;
        }
        
        /* Buttons */
        .btn-action {
            padding: 5px 10px;
            margin: 0 2px;
            border-radius: 3px;
        }
        
        /* Footer admin */
        .admin-footer {
            margin-top: 30px;
            padding: 20px;
            background: white;
            border-radius: 5px;
            text-align: center;
            color: #666;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                padding-top: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="text-center py-4">
            <i class="bi bi-cup-hot-fill text-white" style="font-size: 2rem;"></i>
            <h6 class="text-white mt-2">Janji Martahan Coffee</h6>
            <small class="text-white-50">Admin Panel</small>
        </div>
        
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            
            <li class="nav-item mt-2">
                <small class="text-white-50 px-3">MANAJEMEN</small>
            </li>
            
           <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.testimoni*') ? 'active' : '' }}" 
                   href="{{ route('admin.testimoni.index') }}">
                    <i class="bi bi-star"></i> Testimoni
                </a>
            </li>
            
          
        
            
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.about.index*') ? 'active' : '' }}" 
                   href="{{ route('admin.about.index') }}">
                    <i class="bi bi-info-circle"></i> About Us
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <hr class="border-white-10">
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}" target="_blank">
                    <i class="bi bi-eye"></i> Lihat Website
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link text-danger" href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Navbar Admin -->
        <div class="navbar-admin d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
            </div>
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-bell"></i>
                </div>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-2"></i>
                        {{ Auth::user()->name ?? 'Admin' }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>

        <!-- Footer -->
        <div class="admin-footer">
            <small>&copy; {{ date('Y') }} Janji Martahan Coffee. All rights reserved.</small>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>