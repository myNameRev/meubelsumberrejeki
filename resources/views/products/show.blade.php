@extends('layouts.app')

@section('title', $product->name . ' - Meubel Sumber Rejeki')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="breadcrumb">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Kategori</a></li>
            <li class="breadcrumb-item"><a href="{{ route('categories.show', $product->category->slug) }}">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </div>
</nav>

<!-- Product Detail -->
<section>
    <div class="container">
        <div class="row g-5">
            <!-- Product Image -->
            <div class="col-lg-6">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/500x500/F5F1E8/8B6F47?text=' . urlencode($product->name) }}" 
                     alt="{{ $product->name }}" class="img-fluid rounded" style="width: 100%; max-height: 600px; object-fit: cover;">
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="mb-4">
                    <span class="category-badge">{{ $product->category->name }}</span>
                    @if($product->is_featured)
                        <span class="badge ms-2" style="background-color: var(--primary);">
                            <i class="fas fa-star"></i> Produk Unggulan
                        </span>
                    @endif
                </div>

                <h1 style="color: var(--primary); font-weight: 800; margin-bottom: 15px;">{{ $product->name }}</h1>

                <!-- Price -->
                <div class="mb-4" style="border-bottom: 2px solid var(--secondary); padding-bottom: 20px;">
                    <div class="product-price mb-3" style="font-size: 2.5rem;">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h5 style="color: var(--primary); font-weight: 700;">Deskripsi Produk</h5>
                    <p style="font-size: 1.05rem; color: var(--dark); line-height: 1.8;">
                        {{ $product->description }}
                    </p>
                </div>

                <!-- Product Details -->
                <div class="mb-4">
                    <h5 style="color: var(--primary); font-weight: 700; margin-bottom: 15px;">Spesifikasi Produk</h5>
                    <div class="row g-3">
                        @if($product->material)
                            <div class="col-12">
                                <strong>Material:</strong> {{ $product->material }}
                            </div>
                        @endif
                        @if($product->color)
                            <div class="col-12">
                                <strong>Warna:</strong> {{ $product->color }}
                            </div>
                        @endif
                        @if($product->dimension)
                            <div class="col-12">
                                <strong>Dimensi:</strong> {{ $product->dimension }}
                            </div>
                        @endif
                        <div class="col-12">
                            <strong>Stok Tersedia:</strong>
                            @if($product->stock > 0)
                                <span class="badge bg-success" style="padding: 8px 12px;">
                                    <i class="fas fa-check-circle"></i> {{ $product->stock }} Tersedia
                                </span>
                            @else
                                <span class="badge bg-danger" style="padding: 8px 12px;">
                                    <i class="fas fa-times-circle"></i> Habis
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2 d-md-flex">
                    @if($product->stock > 0)
                        <button class="btn btn-primary btn-lg" onclick="alert('Fitur pembelian akan segera tersedia!')">
                            <i class="fas fa-shopping-cart"></i> Pesan Sekarang
                        </button>
                    @else
                        <button class="btn btn-secondary btn-lg" disabled>
                            <i class="fas fa-times"></i> Habis Terjual
                        </button>
                    @endif
                    <button class="btn btn-outline-primary btn-lg" onclick="alert('Fitur kontak akan segera tersedia!')">
                        <i class="fas fa-envelope"></i> Hubungi Kami
                    </button>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <hr style="margin: 60px 0; border-color: var(--secondary);">

        <h2 style="color: var(--primary); font-weight: 800; margin-bottom: 40px; text-align: center;">
            <i class="fas fa-link"></i> Produk Terkait
        </h2>

        <div class="row g-4">
            @foreach($relatedProducts as $related)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <a href="{{ route('products.show', $related->slug) }}" class="text-decoration-none">
                        <div class="card">
                            <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://via.placeholder.com/300x250/F5F1E8/8B6F47?text=' . urlencode($related->name) }}" 
                                 alt="{{ $related->name }}" style="height: 250px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $related->name }}</h5>
                                <p class="card-text text-truncate">{{ $related->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="product-price">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                                    <span class="badge" style="background-color: var(--primary);">
                                        <i class="fas fa-box"></i> {{ $related->stock }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
