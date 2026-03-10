<!-- resources/views/guest/login.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #2c1810; min-height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="bg-white p-4 rounded shadow">
                    <h4 class="text-center mb-4">Login Pelanggan</h4>
                    
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <small>{{ $error }}</small><br>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('guest.login') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                        
                        <button type="submit" class="btn w-100" style="background: #2c1810; color: white;">
                            Login
                        </button>
                    </form>
                    
                    <div class="text-center mt-3">
                        <small>
                            Belum punya akun? 
                            <a href="{{ route('guest.register.form') }}" style="color: #c4a27a;">Daftar</a>
                        </small>
                        <br>
                        <small>
                            <a href="{{ route('home') }}" style="color: #6c757d;">Kembali ke Beranda</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>