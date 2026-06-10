@extends('layouts.app')

@section('title', 'Beranda - Meubel Sumber Rejeki')

@section('content')
<!-- Hero Section -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TJ70CVEC40"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-TJ70CVEC40');
</script>
<div class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1>Meubel Berkualitas untuk Rumah Impian Anda</h1>
                <p>Kami menyediakan koleksi meubel terlengkap dengan kualitas premium dan harga terjangkau.</p>
                <a href="{{ route('categories.index') }}" class="btn btn-primary btn-lg me-3">
                    <i class="fas fa-shopping-cart"></i> Belanja Sekarang
                </a>
                <a href="#katalog" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-list"></i> Lihat Katalog
                </a>
            </div>
            <div class="col-lg-6">
                <img src="https://via.placeholder.com/500x400/F5F1E8/8B6F47?text=Meubel+Sumber+Rejeki" 
                     alt="Meubel" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>

<!-- Featured Products Section -->
<section class="bg-white" id="katalog">
    <div class="container">
        <h2><i class="fas fa-star"></i> Produk Unggulan</h2>
        <p class="section-subtitle">Pilihan terbaik dari koleksi meubel kami yang paling diminati pelanggan</p>
        
        @if($featuredProducts->count() > 0)
            <div class="row g-4">
                @foreach($featuredProducts as $product)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none">
                            <div class="card">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x250/F5F1E8/8B6F47?text=' . urlencode($product->name) }}" 
                                     alt="{{ $product->name }}">
                                <div class="card-body">
                                    <span class="category-badge">{{ $product->category->name }}</span>
                                    <h5 class="card-title mt-3">{{ $product->name }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 80) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        <span class="badge">
                                            <i class="fas fa-box"></i> {{ $product->stock }} stok
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> Belum ada produk unggulan. Silahkan kembali nanti.
            </div>
        @endif
    </div>
</section>

<!-- Latest Products Section -->
<section style="background-color: var(--secondary);">
    <div class="container">
        <h2><i class="fas fa-fire"></i> Produk Terbaru</h2>
        <p class="section-subtitle">Koleksi produk meubel terbaru yang baru saja kami tambahkan</p>
        
        @if($latestProducts->count() > 0)
            <div class="row g-4">
                @foreach($latestProducts as $product)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none">
                            <div class="card">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x250/F5F1E8/8B6F47?text=' . urlencode($product->name) }}" 
                                     alt="{{ $product->name }}">
                                <div class="card-body">
                                    <span class="category-badge">{{ $product->category->name }}</span>
                                    <h5 class="card-title mt-3">{{ $product->name }}</h5>
                                    <p class="card-text text-truncate">{{ $product->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        <span class="badge">
                                            <i class="fas fa-box"></i> {{ $product->stock }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> Belum ada produk tersedia.
            </div>
        @endif

        <div class="text-center mt-5">
            <a href="{{ route('categories.index') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-th"></i> Lihat Semua Produk
            </a>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section>
    <div class="container">
        <h2><i class="fas fa-list"></i> Kategori Produk</h2>
        <p class="section-subtitle">Jelajahi berbagai kategori meubel yang kami sediakan</p>
        
        @if($categories->count() > 0)
            <div class="row g-4">
                @foreach($categories as $category)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <a href="{{ route('categories.show', $category->slug) }}" class="text-decoration-none">
                            <div class="card text-center">
                                <img src="{{ $category->image ? asset('storage/' . $category->image) : 'https://via.placeholder.com/300x250/F5F1E8/8B6F47?text=' . urlencode($category->name) }}" 
                                     alt="{{ $category->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $category->name }}</h5>
                                    <p class="card-text">{{ Str::limit($category->description, 100) }}</p>
                                    <a href="{{ route('categories.show', $category->slug) }}" class="btn btn-sm btn-primary">
                                        Lihat Kategori
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> Belum ada kategori tersedia.
            </div>
        @endif
    </div>
</section>

<!-- About Section -->
<section style="background-color: var(--secondary);" id="tentang">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <img src="https://via.placeholder.com/500x400/F5F1E8/8B6F47?text=Tentang+Kami" 
                     alt="Tentang Kami" class="img-fluid rounded">
            </div>
            <div class="col-lg-6">
                <h2>Tentang Meubel Sumber Rejeki</h2>
                <p>Kami adalah penyedia meubel berkualitas tinggi yang telah melayani ribuan pelanggan puas selama bertahun-tahun. 
                   Dengan komitmen terhadap kualitas dan kepuasan pelanggan, kami terus berinovasi dalam menghadirkan desain meubel 
                   yang modern, fungsional, dan terjangkau.</p>
                <ul class="list-unstyled mt-4">
                    <li class="mb-3">
                        <i class="fas fa-check-circle" style="color: var(--primary);"></i> 
                        <strong>Kualitas Premium</strong> - Semua produk menggunakan material pilihan terbaik
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-check-circle" style="color: var(--primary);"></i> 
                        <strong>Harga Kompetitif</strong> - Kami menawarkan harga terbaik di pasaran
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-check-circle" style="color: var(--primary);"></i> 
                        <strong>Desain Modern</strong> - Koleksi terbaru sesuai tren furniture internasional
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-check-circle" style="color: var(--primary);"></i> 
                        <strong>Layanan Terbaik</strong> - Tim profesional siap membantu Anda
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="kontak">
    <div class="container">
        <h2 style="text-align: center;">Hubungi Kami</h2>
        <p class="section-subtitle">Kami siap membantu Anda dengan pertanyaan atau pesanan</p>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-phone fa-3x mb-3" style="color: var(--primary);"></i>
                        <h5 class="card-title">Telepon</h5>
                        <p class="card-text">08985918179</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-envelope fa-3x mb-3" style="color: var(--primary);"></i>
                        <h5 class="card-title">Email</h5>
                        <p class="card-text">info@meubelsumberrejeki.com</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-map-marker-alt fa-3x mb-3" style="color: var(--primary);"></i>
                        <h5 class="card-title">Lokasi</h5>
                        <p class="card-text">Jalan Kaliurang Km 8,5<br>Sinduharjo, Ngaglik, Sleman, Yogyakarta</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
