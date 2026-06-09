@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <i class="fas fa-box"></i>
            <h6>Total Produk</h6>
            <div class="stat-value">{{ $totalProducts }}</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <i class="fas fa-list"></i>
            <h6>Kategori</h6>
            <div class="stat-value">{{ $totalCategories }}</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <i class="fas fa-star"></i>
            <h6>Produk Unggulan</h6>
            <div class="stat-value">{{ $totalFeatured }}</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <i class="fas fa-exclamation-triangle"></i>
            <h6>Stok Terbatas</h6>
            <div class="stat-value">{{ $lowStock }}</div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <h6>Total Mitra</h6>
            <div class="stat-value">{{ $totalMitraks }}</div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-history"></i> Produk Terbaru
                </h5>
            </div>
            <div class="card-body">
                @if($latestProducts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestProducts as $product)
                                    <tr>
                                        <td><strong>{{ $product->name }}</strong></td>
                                        <td>
                                            <span class="badge" style="background-color: var(--primary);">
                                                {{ $product->category->name }}
                                            </span>
                                        </td>
                                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td>
                                            @if($product->stock > 10)
                                                <span class="badge bg-success">{{ $product->stock }}</span>
                                            @elseif($product->stock > 0)
                                                <span class="badge bg-warning text-dark">{{ $product->stock }}</span>
                                            @else
                                                <span class="badge bg-danger">Habis</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->is_featured)
                                                <span class="badge" style="background-color: var(--primary);">
                                                    <i class="fas fa-star"></i> Unggulan
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Normal</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                                               class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center text-muted">Belum ada produk</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-list"></i> Manajemen Cepat</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary w-100 mb-2">
                    <i class="fas fa-list"></i> Kelola Kategori
                </a>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-success w-100">
                    <i class="fas fa-plus"></i> Tambah Kategori
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-box"></i> Manajemen Cepat</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary w-100 mb-2">
                    <i class="fas fa-box"></i> Kelola Produk
                </a>
                <a href="{{ route('admin.products.create') }}" class="btn btn-success w-100">
                    <i class="fas fa-plus"></i> Tambah Produk
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
