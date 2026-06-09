@extends('layouts.app')

@section('title', 'Kategori - Meubel Sumber Rejeki')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="breadcrumb">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Kategori</li>
        </ol>
    </div>
</nav>

<!-- Categories Section -->
<section>
    <div class="container">
        <h2><i class="fas fa-list"></i> Semua Kategori Meubel</h2>
        <p class="section-subtitle">Pilih kategori untuk melihat produk yang tersedia</p>

        @if($categories->count() > 0)
            <div class="row g-4">
                @foreach($categories as $category)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="{{ route('categories.show', $category->slug) }}" class="text-decoration-none">
                            <div class="card h-100">
                                <img src="{{ $category->image ? asset('storage/' . $category->image) : 'https://via.placeholder.com/400x300/F5F1E8/8B6F47?text=' . urlencode($category->name) }}" 
                                     alt="{{ $category->name }}" style="height: 300px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $category->name }}</h5>
                                    <p class="card-text">{{ $category->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary">
                                            <i class="fas fa-box"></i> {{ $category->products_count ?? 0 }} Produk
                                        </span>
                                        <a href="{{ route('categories.show', $category->slug) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-arrow-right"></i> Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center" role="alert">
                <i class="fas fa-info-circle"></i> Belum ada kategori tersedia.
            </div>
        @endif
    </div>
</section>
@endsection
