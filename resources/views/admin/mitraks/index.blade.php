@extends('layouts.admin')

@section('page_title', 'Manajemen Mitra')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <a href="{{ route('admin.mitraks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Mitra
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-users"></i> Daftar Mitra
        </h5>
    </div>
    <div class="card-body">
        @if($mitraks->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Nama Mitra</th>
                            <th>Kontak</th>
                            <th>Kota</th>
                            <th>Status</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mitraks as $mitra)
                            <tr>
                                <td>{{ ($mitraks->currentPage() - 1) * $mitraks->perPage() + $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $mitra->name }}</strong>
                                    @if($mitra->image)
                                        <br>
                                        <img src="{{ asset('storage/mitraks/' . $mitra->image) }}" 
                                             alt="{{ $mitra->name }}" 
                                             style="width: 30px; height: 30px; object-fit: cover; border-radius: 3px;">
                                    @endif
                                </td>
                                <td>
                                    @if($mitra->phone)
                                        <div><i class="fas fa-phone"></i> {{ $mitra->phone }}</div>
                                    @endif
                                    @if($mitra->email)
                                        <div><i class="fas fa-envelope"></i> {{ $mitra->email }}</div>
                                    @endif
                                </td>
                                <td>{{ $mitra->city ?? '-' }}</td>
                                <td>
                                    <span class="badge" style="background-color: var(--primary);">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.mitraks.edit', $mitra->id) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.mitraks.destroy', $mitra->id) }}" 
                                          method="POST" 
                                          style="display: inline-block;"
                                          onsubmit="return confirm('Yakin ingin menghapus mitra ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $mitraks->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x mb-3" style="color: #ccc;"></i>
                <p class="text-muted">Belum ada data mitra</p>
            </div>
        @endif
    </div>
</div>
@endsection
