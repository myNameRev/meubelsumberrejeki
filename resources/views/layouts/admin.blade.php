<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Meubel Sumber Rejeki')</title>
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
            background-color: var(--light);
            color: var(--dark);
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--dark);
            color: var(--accent);
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar .brand {
            padding: 20px;
            border-bottom: 2px solid var(--primary);
            margin-bottom: 20px;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--secondary);
        }

        .sidebar a {
            color: var(--accent);
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: var(--primary);
            border-left: 4px solid var(--secondary);
            padding-left: 17px;
        }

        .sidebar .nav-section {
            margin-top: 20px;
        }

        .sidebar .nav-section-title {
            padding: 10px 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--secondary);
            opacity: 0.7;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
        }

        .topbar {
            background-color: var(--accent);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(92, 74, 61, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h1 {
            color: var(--primary);
            font-weight: 700;
            margin: 0;
            font-size: 1.8rem;
        }

        .topbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .topbar .user-info a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(92, 74, 61, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: var(--primary);
            color: var(--accent);
            font-weight: 700;
            border-radius: 10px 10px 0 0;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--dark);
            border-color: var(--dark);
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: var(--dark);
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        /* Table */
        .table {
            background-color: var(--accent);
        }

        .table thead th {
            background-color: var(--primary);
            color: var(--accent);
            font-weight: 700;
            border: none;
        }

        .table tbody tr:hover {
            background-color: var(--light);
        }

        /* Form */
        .form-control,
        .form-select {
            border-color: var(--secondary);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(139, 111, 71, 0.25);
        }

        .form-label {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 8px;
        }

        /* Alert */
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffeeba;
            color: #856404;
        }

        /* Stat Cards */
        .stat-card {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--light) 100%);
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(92, 74, 61, 0.1);
        }

        .stat-card i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .stat-card h6 {
            color: var(--dark);
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            color: var(--primary);
            font-weight: 800;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                margin-bottom: 20px;
            }

            .main-content {
                margin-left: 0;
            }

            .admin-wrapper {
                flex-direction: column;
            }

            .topbar {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="brand">
                <i class="fas fa-chair"></i> Admin Panel
            </div>
            
            <a href="{{ route('admin.dashboard') }}" class="@if(request()->route()->getName() === 'admin.dashboard') active @endif">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>

            <div class="nav-section">
                <div class="nav-section-title">Kelola Data</div>
                <a href="{{ route('admin.categories.index') }}" class="@if(str_contains(request()->route()->getName(), 'categories')) active @endif">
                    <i class="fas fa-list"></i> Kategori
                </a>
                <a href="{{ route('admin.products.index') }}" class="@if(str_contains(request()->route()->getName(), 'products')) active @endif">
                    <i class="fas fa-box"></i> Produk
                </a>
                <a href="{{ route('admin.mitraks.index') }}" class="@if(str_contains(request()->route()->getName(), 'mitraks')) active @endif">
                    <i class="fas fa-users"></i> Mitra
                </a>
            </div>

            <div class="nav-section" style="margin-top: auto; border-top: 1px solid rgba(245, 241, 232, 0.2); padding-top: 20px;">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm w-100">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Topbar -->
            <div class="topbar">
                <h1>@yield('page_title', 'Dashboard')</h1>
                <div class="user-info">
                    <span>{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                    <a href="#" onclick="event.preventDefault(); document.querySelector('.logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST" class="logout-form d-none">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- Alert Messages -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-times-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
