@extends('layouts.admin')

@section('page_title', 'Edit Mitra')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-edit"></i> Edit Mitra
                </h5>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.mitraks.update', $mitra->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Mitra <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $mitra->name) }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="3">{{ old('description', $mitra->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact_person" class="form-label">Nama Kontak</label>
                        <input type="text" 
                               class="form-control @error('contact_person') is-invalid @enderror" 
                               id="contact_person" 
                               name="contact_person" 
                               value="{{ old('contact_person', $mitra->contact_person) }}">
                        @error('contact_person')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" 
                               class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone', $mitra->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $mitra->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" 
                                  name="address" 
                                  rows="2">{{ old('address', $mitra->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">Kota</label>
                        <input type="text" 
                               class="form-control @error('city') is-invalid @enderror" 
                               id="city" 
                               name="city" 
                               value="{{ old('city', $mitra->city) }}">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Logo/Gambar Mitra</label>
                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image"
                               accept="image/*">
                        <small class="form-text text-muted">Format: JPG, PNG, GIF | Max: 2MB | Biarkan kosong untuk tidak mengubah</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($mitra->image)
                        <div class="mb-3">
                            <label class="form-label">Gambar Saat Ini</label>
                            <div>
                                <img src="{{ asset('storage/mitraks/' . $mitra->image) }}" 
                                     alt="{{ $mitra->name }}" 
                                     style="max-width: 150px; height: auto; border-radius: 5px;">
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Mitra
                        </button>
                        <a href="{{ route('admin.mitraks.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card" style="background-color: var(--secondary); border-left: 4px solid var(--primary);">
            <div class="card-body">
                <h6 class="card-title">
                    <i class="fas fa-info-circle" style="color: var(--primary);"></i> Informasi Mitra
                </h6>
                <ul class="small">
                    <li><strong>Nama:</strong> {{ $mitra->name }}</li>
                    <li><strong>Slug:</strong> {{ $mitra->slug }}</li>
                    <li><strong>Dibuat:</strong> {{ $mitra->created_at->format('d M Y H:i') }}</li>
                    <li><strong>Diubah:</strong> {{ $mitra->updated_at->format('d M Y H:i') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
