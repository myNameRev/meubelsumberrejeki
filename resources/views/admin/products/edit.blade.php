@extends('layouts.admin')

@section('page_title', 'Edit Produk')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit"></i> Form Edit Produk</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label">Kategori *</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    id="category_id" name="category_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            @selected(old('category_id', $product->category_id) == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama Produk *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $product->name) }}" 
                                   placeholder="Masukkan nama produk" required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" 
                                  placeholder="Masukkan deskripsi produk" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Harga *</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01"
                                   placeholder="0" required>
                            @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">Stok *</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                   id="stock" name="stock" value="{{ old('stock', $product->stock) }}" 
                                   placeholder="0" required>
                            @error('stock')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="material" class="form-label">Material</label>
                            <input type="text" class="form-control @error('material') is-invalid @enderror" 
                                   id="material" name="material" value="{{ old('material', $product->material) }}" 
                                   placeholder="contoh: Kayu Jati">
                            @error('material')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="color" class="form-label">Warna</label>
                            <input type="text" class="form-control @error('color') is-invalid @enderror" 
                                   id="color" name="color" value="{{ old('color', $product->color) }}" 
                                   placeholder="contoh: Coklat">
                            @error('color')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="dimension" class="form-label">Dimensi</label>
                            <input type="text" class="form-control @error('dimension') is-invalid @enderror" 
                                   id="dimension" name="dimension" value="{{ old('dimension', $product->dimension) }}" 
                                   placeholder="contoh: 100x50x80 cm">
                            @error('dimension')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Produk</label>
                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" style="max-width: 200px; border-radius: 8px;">
                                <br>
                                <small class="text-muted">Gambar saat ini</small>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Format: JPG, PNG, GIF (Max: 2MB) - Kosongkan jika tidak ingin mengubah</small>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" 
                                   name="is_featured" value="1" @checked(old('is_featured', $product->is_featured))>
                            <label class="form-check-label" for="is_featured">
                                <i class="fas fa-star"></i> Jadikan Produk Unggulan
                            </label>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Produk</h5>
            </div>
            <div class="card-body">
                <p><strong>Slug:</strong></p>
                <code>{{ $product->slug }}</code>
                <hr>
                <p><strong>Status Stok:</strong></p>
                @if($product->stock > 10)
                    <span class="badge bg-success">Tersedia Banyak</span>
                @elseif($product->stock > 0)
                    <span class="badge bg-warning text-dark">Stok Terbatas</span>
                @else
                    <span class="badge bg-danger">Habis</span>
                @endif
                <hr>
                <p><strong>Kategori:</strong></p>
                <p>{{ $product->category->name }}</p>
                <hr>
                <p><small class="text-muted">Dibuat: {{ $product->created_at->format('d M Y H:i') }}</small></p>
                <p><small class="text-muted">Diupdate: {{ $product->updated_at->format('d M Y H:i') }}</small></p>
            </div>
        </div>
    </div>
</div>
@endsection
