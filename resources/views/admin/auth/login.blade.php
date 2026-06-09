<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Meubel Sumber Rejeki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #8B6F47;
            --secondary: #F5F1E8;
            --accent: #FFFFFF;
            --dark: #5C4A3D;
            --light: #F9F7F4;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--secondary) 0%, var(--light) 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--dark);
        }

        .login-container {
            background-color: var(--accent);
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(92, 74, 61, 0.2);
            width: 100%;
            max-width: 450px;
            padding: 40px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header i {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .login-header h1 {
            color: var(--primary);
            font-weight: 800;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .login-header p {
            color: var(--dark);
            font-size: 0.95rem;
        }

        .form-control {
            border-color: var(--secondary);
            padding: 12px 15px;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(139, 111, 71, 0.25);
        }

        .form-control::placeholder {
            color: rgba(92, 74, 61, 0.5);
        }

        .form-label {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .btn-login {
            background-color: var(--primary);
            border-color: var(--primary);
            color: var(--accent);
            padding: 12px;
            font-weight: 700;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: var(--dark);
            border-color: var(--dark);
            color: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(92, 74, 61, 0.2);
        }

        .form-check-input {
            border-color: var(--secondary);
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-label {
            color: var(--dark);
            font-size: 0.9rem;
            margin-left: 8px;
        }

        .login-footer {
            text-align: center;
            margin-top: 20px;
        }

        .login-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .back-to-home {
            text-align: center;
            margin-top: 20px;
        }

        .back-to-home a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <i class="fas fa-chair"></i>
            <h1>Admin Panel</h1>
            <p>Meubel Sumber Rejeki</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Login Gagal!</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" 
                       placeholder="masukkan email anda" required autofocus>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" 
                       placeholder="masukkan password anda" required>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="btn btn-login w-100">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>

        <div class="back-to-home">
            <a href="{{ route('home') }}">
                <i class="fas fa-arrow-left"></i> Kembali ke Website
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
