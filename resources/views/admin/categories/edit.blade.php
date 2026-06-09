@extends('layouts.admin')

@section('page_title', 'Edit Kategori')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit"></i> Form Edit Kategori</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $category->name) }}" 
                               placeholder="Masukkan nama kategori" required>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" 
                                  placeholder="Masukkan deskripsi kategori">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Kategori</label>
                        @if($category->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $category->image) }}" 
                                     alt="{{ $category->name }}" style="max-width: 200px; border-radius: 8px;">
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

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Kategori</h5>
            </div>
            <div class="card-body">
                <p><strong>Slug:</strong></p>
                <code>{{ $category->slug }}</code>
                <hr>
                <p><strong>Produk dalam Kategori:</strong></p>
                <p>{{ $category->products()->count() }} produk</p>
                <hr>
                <p><small class="text-muted">Dibuat: {{ $category->created_at->format('d M Y H:i') }}</small></p>
                <p><small class="text-muted">Diupdate: {{ $category->updated_at->format('d M Y H:i') }}</small></p>
            </div>
        </div>
    </div>
</div>
@endsection
