@extends('layouts.app')

@section('title', $category->name . ' - Meubel Sumber Rejeki')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="breadcrumb">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Kategori</a></li>
            <li class="breadcrumb-item active">{{ $category->name }}</li>
        </ol>
    </div>
</nav>

<!-- Category Header -->
<section style="background-color: var(--secondary); padding: 60px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="{{ $category->image ? asset('storage/' . $category->image) : 'https://via.placeholder.com/500x400/F5F1E8/8B6F47?text=' . urlencode($category->name) }}" 
                     alt="{{ $category->name }}" class="img-fluid rounded" style="height: 400px; object-fit: cover;">
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h1 style="color: var(--primary); font-weight: 800; margin-bottom: 20px;">{{ $category->name }}</h1>
                <p style="font-size: 1.1rem; color: var(--dark); margin-bottom: 20px;">{{ $category->description }}</p>
                <p>
                    <strong>Total Produk:</strong> 
                    <span class="badge bg-primary" style="padding: 10px 15px; font-size: 1rem;">
                        {{ $products->total() }} produk
                    </span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Products Grid -->
<section>
    <div class="container">
        <h2><i class="fas fa-th"></i> Produk di Kategori {{ $category->name }}</h2>

        @if($products->count() > 0)
            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none">
                            <div class="card">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x250/F5F1E8/8B6F47?text=' . urlencode($product->name) }}" 
                                     alt="{{ $product->name }}">
                                <div class="card-body">
                                    @if($product->is_featured)
                                        <span class="badge mb-2" style="background-color: var(--primary);">
                                            <i class="fas fa-star"></i> Unggulan
                                        </span>
                                    @endif
                                    <h5 class="card-title mt-2">{{ $product->name }}</h5>
                                    <p class="card-text text-truncate">{{ $product->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        <span class="badge" style="background-color: var(--primary);">
                                            <i class="fas fa-box"></i> {{ $product->stock }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row mt-5">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        {{ $products->links() }}
                    </nav>
                </div>
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> Belum ada produk di kategori ini.
            </div>
        @endif
    </div>
</section>

<!-- Other Categories -->
@if($categories->count() > 1)
<section style="background-color: var(--secondary);">
    <div class="container">
        <h2><i class="fas fa-list"></i> Kategori Lainnya</h2>
        <p class="section-subtitle">Jelajahi kategori meubel lainnya</p>

        <div class="row g-4">
            @foreach($categories->where('id', '!=', $category->id)->take(3) as $otherCategory)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="{{ route('categories.show', $otherCategory->slug) }}" class="text-decoration-none">
                        <div class="card text-center">
                            <img src="{{ $otherCategory->image ? asset('storage/' . $otherCategory->image) : 'https://via.placeholder.com/300x250/F5F1E8/8B6F47?text=' . urlencode($otherCategory->name) }}" 
                                 alt="{{ $otherCategory->name }}" style="height: 250px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $otherCategory->name }}</h5>
                                <a href="{{ route('categories.show', $otherCategory->slug) }}" class="btn btn-sm btn-primary">
                                    Lihat Kategori
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
