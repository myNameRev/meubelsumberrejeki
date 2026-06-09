@extends('layouts.admin')

@section('page_title', 'Manajemen Kategori')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Kategori</h5>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-success">
            <i class="fas fa-plus"></i> Tambah Kategori
        </a>
    </div>
    <div class="card-body">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Deskripsi</th>
                            <th>Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                                <td>
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" 
                                             style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px; margin-right: 10px;">
                                    @endif
                                    <strong>{{ $category->name }}</strong>
                                </td>
                                <td>
                                    <code>{{ $category->slug }}</code>
                                </td>
                                <td>{{ Str::limit($category->description, 50) }}</td>
                                <td>
                                    <span class="badge" style="background-color: var(--primary);">
                                        {{ $category->products()->count() }} Produk
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" 
                                          style="display: inline-block;" 
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
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
                {{ $categories->links() }}
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> Belum ada kategori. 
                <a href="{{ route('admin.categories.create') }}">Buat kategori baru</a>
            </div>
        @endif
    </div>
</div>
@endsection
