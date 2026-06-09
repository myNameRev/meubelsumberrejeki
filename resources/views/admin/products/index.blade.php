@extends('layouts.admin')

@section('page_title', 'Manajemen Produk')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-box"></i> Daftar Produk</h5>
        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-success">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>
    <div class="card-body">
        @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                             style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px; margin-right: 10px;">
                                    @endif
                                    <strong>{{ $product->name }}</strong>
                                </td>
                                <td>
                                    <span class="badge" style="background-color: var(--primary);">
                                        {{ $product->category->name }}
                                    </span>
                                </td>
                                <td><strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></td>
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
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" 
                                          style="display: inline-block;" 
                                          onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                {{ $products->links() }}
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> Belum ada produk. 
                <a href="{{ route('admin.products.create') }}">Buat produk baru</a>
            </div>
        @endif
    </div>
</div>
@endsection
