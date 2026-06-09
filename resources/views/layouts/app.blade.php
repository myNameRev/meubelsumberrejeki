<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meubel Sumber Rejeki')</title>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }

        /* Navbar Styling */
        .navbar {
            background-color: var(--accent);
            box-shadow: 0 2px 8px rgba(92, 74, 61, 0.1);
            border-bottom: 3px solid var(--primary);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary) !important;
        }

        .nav-link {
            color: var(--dark) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 8px;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            text-decoration: underline;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--light) 100%);
            padding: 80px 0;
            border-bottom: 5px solid var(--primary);
        }

        .hero h1 {
            color: var(--primary);
            font-weight: 800;
            margin-bottom: 20px;
            font-size: 3rem;
        }

        .hero p {
            color: var(--dark);
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--dark);
            border-color: var(--dark);
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(92, 74, 61, 0.1);
            transition: all 0.3s ease;
            background-color: var(--accent);
            height: 100%;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(92, 74, 61, 0.15);
        }

        .card-title {
            color: var(--primary);
            font-weight: 700;
        }

        .card-text {
            color: var(--dark);
        }

        .card img {
            border-radius: 15px 15px 0 0;
            height: 250px;
            object-fit: cover;
        }

        .product-price {
            font-size: 1.5rem;
            color: var(--primary);
            font-weight: 800;
        }

        /* Section Styling */
        section {
            padding: 60px 0;
        }

        section h2 {
            color: var(--primary);
            font-weight: 800;
            margin-bottom: 40px;
            text-align: center;
            font-size: 2.5rem;
        }

        .section-subtitle {
            color: var(--dark);
            text-align: center;
            margin-bottom: 50px;
            font-size: 1.1rem;
        }

        /* Footer */
        footer {
            background-color: var(--dark);
            color: var(--secondary);
            padding: 40px 0;
            margin-top: 80px;
        }

        footer h5 {
            color: var(--secondary);
            font-weight: 700;
            margin-bottom: 15px;
        }

        footer a {
            color: var(--secondary);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        footer a:hover {
            color: var(--primary);
        }

        .footer-divider {
            border-top: 1px solid rgba(245, 241, 232, 0.2);
            margin-top: 30px;
            padding-top: 30px;
        }

        /* Breadcrumb */
        .breadcrumb {
            background-color: var(--secondary);
            padding: 15px 0;
            margin-bottom: 30px;
        }

        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: var(--dark);
        }

        /* Category Badge */
        .category-badge {
            display: inline-block;
            background-color: var(--primary);
            color: var(--accent);
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* Pagination */
        .pagination .page-link {
            color: var(--primary);
            border-color: var(--primary);
        }

        .pagination .page-link:hover {
            background-color: var(--primary);
            border-color: var(--primary);
            color: var(--accent);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        /* Badge */
        .badge {
            background-color: var(--primary);
            padding: 8px 12px;
            font-weight: 600;
        }

        .badge-secondary {
            background-color: var(--secondary);
            color: var(--primary);
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-chair"></i> Meubel Sumber Rejeki
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">Katalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">
                            <i class="fas fa-lock"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5><i class="fas fa-chair"></i> Meubel Sumber Rejeki</h5>
                    <p>Menyediakan meubel berkualitas tinggi dengan desain modern dan tahan lama.</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Menu</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('categories.index') }}">Katalog</a></li>
                        <li><a href="#tentang">Tentang Kami</a></li>
                        <li><a href="#kontak">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Kategori Populer</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('categories.index') }}">Kursi</a></li>
                        <li><a href="{{ route('categories.index') }}">Meja</a></li>
                        <li><a href="{{ route('categories.index') }}">Lemari</a></li>
                        <li><a href="{{ route('categories.index') }}">Sofa</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Hubungi Kami</h5>
                    <p><i class="fas fa-phone"></i> 08985918179</p>
                    <p><i class="fas fa-envelope"></i> info@meubelsumberrejeki.com</p>
                    <p><i class="fas fa-map-marker-alt"></i> Jalan Kaliurang Km 8,5, Sinduharjo, Ngaglik, Sleman, Yogyakarta</p>
                </div>
            </div>
            <div class="footer-divider">
                <div class="row">
                    <div class="col-12 text-center">
                        <p>&copy; 2026 Meubel Sumber Rejeki. Semua hak dilindungi.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
