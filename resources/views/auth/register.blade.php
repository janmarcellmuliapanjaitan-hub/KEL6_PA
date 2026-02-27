<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Janji Martahan Coffee Admin</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #2c1810 0%, #4a2c20 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        
        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }
        
        .register-header {
            background: #2c1810;
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .register-header i {
            font-size: 3rem;
            color: #c4a27a;
        }
        
        .register-body {
            padding: 40px;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ddd;
        }
        
        .form-control:focus {
            border-color: #c4a27a;
            box-shadow: 0 0 0 0.2rem rgba(196, 162, 122, 0.25);
        }
        
        .btn-register {
            background: #2c1810;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }
        
        .btn-register:hover {
            background: #4a2c20;
            transform: translateY(-2px);
        }
        
        .input-group-text {
            background: #f8f9fa;
            border-left: none;
        }
        
        .form-control:focus + .input-group-text {
            border-color: #c4a27a;
        }
        
        .brand-icon {
            color: #c4a27a;
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .login-link a {
            color: #c4a27a;
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .info-box {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .info-box i {
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="register-card">
                    <div class="register-header">
                        <i class="bi bi-cup-hot-fill"></i>
                        <h4 class="mt-3 mb-1">Janji Martahan Coffee</h4>
                        <small class="text-white-50">Admin Registration</small>
                    </div>
                    
                    <div class="register-body">
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

                        <div class="info-box">
                            <i class="bi bi-info-circle me-2"></i>
                            <small>Halaman ini hanya untuk mendaftarkan akun administrator. Akun user regular tidak dapat mendaftar melalui halaman ini.</small>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="Masukkan nama lengkap"
                                           required 
                                           autofocus>
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="Masukkan email admin"
                                           required>
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Masukkan password (min 8 karakter)"
                                           required>
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="Masukkan ulang password"
                                           required>
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-register">
                                <i class="bi bi-person-plus me-2"></i> Daftar Admin
                            </button>
                        </form>
                        
                        <div class="login-link">
                            <p class="mb-0">Sudah punya akun admin?</p>
                            <a href="{{ route('login') }}">Login di sini</a>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="{{ route('home') }}" class="text-muted text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i> Kembali ke halaman utama
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
