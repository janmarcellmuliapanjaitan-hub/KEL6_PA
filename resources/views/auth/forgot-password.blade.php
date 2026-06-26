<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Janji Martahan Coffee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('{{ asset("image/home.png") }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(26, 15, 8, 0.85); /* Dark overlay */
            backdrop-filter: blur(8px);
            z-index: 1;
        }
        .login-card {
            background: rgba(43, 26, 16, 0.7);
            border: 1px solid rgba(232, 201, 138, 0.3);
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
            backdrop-filter: blur(12px);
            z-index: 2;
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
            margin: 20px 15px;
        }
        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #e8c98a, #d4a373);
        }
        .title {
            font-family: 'Playfair Display', serif;
            color: #e8c98a;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .form-control {
            background: rgba(26, 15, 8, 0.6);
            border: 1px solid rgba(232, 201, 138, 0.2);
            color: #f5e6d3;
            border-radius: 8px;
            padding: 12px 15px 12px 40px;
        }
        .form-control:focus {
            background: rgba(26, 15, 8, 0.8);
            border-color: #e8c98a;
            color: #f5e6d3;
            box-shadow: 0 0 0 0.25rem rgba(232, 201, 138, 0.25);
        }
        .form-control::placeholder {
            color: #c4a27a;
            opacity: 0.7;
        }
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #e8c98a;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #e8c98a, #d4a373);
            border: none;
            color: #1a0f08;
            font-weight: 600;
            border-radius: 8px;
            padding: 12px;
            transition: all 0.3s;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(232, 201, 138, 0.4);
            color: #1a0f08;
        }
        .logo-img {
            width: 70px;
            height: auto;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logo-img">
            <h4 class="title mb-1">Ubah Password</h4>
            <p style="color: #c4a27a; font-size: 0.9rem;">Verifikasi Nama Lengkap & Email untuk memperbarui password Anda secara langsung</p>
        </div>
        
        @if($errors->any())
            <div class="alert alert-danger" style="background: rgba(220,53,69,0.15); border: 1px solid rgba(220,53,69,0.3); color: #ff6b6b; border-radius: 8px; font-size: 0.9rem;">
                @foreach($errors->all() as $error)
                    <div><i class="bi bi-exclamation-circle me-2"></i>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            
            <!-- Email Input -->
            <div class="mb-3 position-relative">
                <i class="bi bi-envelope input-icon"></i>
                <input type="email" name="email" class="form-control" placeholder="Alamat Email" value="{{ old('email') }}" required>
            </div>

            <!-- Full Name (Username) Input -->
            <div class="mb-3 position-relative">
                <i class="bi bi-person input-icon"></i>
                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap (Username)" value="{{ old('name') }}" required>
            </div>

            <!-- New Password Input -->
            <div class="mb-3 position-relative">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" name="password" class="form-control" placeholder="Password Baru" required>
            </div>

            <!-- Confirm New Password Input -->
            <div class="mb-3 position-relative">
                <i class="bi bi-lock-fill input-icon"></i>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password Baru" required>
            </div>
            
            <button type="submit" class="btn btn-primary-custom w-100 mb-3">
                Ubah Password Sekarang
            </button>
        </form>
        
        <div class="text-center">
            <a href="{{ route('guest.login.form') }}" style="color: #e8c98a; font-size: 0.9rem; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#f5e6d3'" onmouseout="this.style.color='#e8c98a'">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Login
            </a>
        </div>
    </div>
</body>
</html>
