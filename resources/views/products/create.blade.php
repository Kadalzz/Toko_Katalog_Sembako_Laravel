@extends('layouts.app')

@section('title', 'Tambah Produk - Toko Sembako Online')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📦 Tambah Produk Baru</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    @if($categories->count() == 0)
        <div class="alert alert-warning">
            ⚠️ Belum ada kategori aktif. Silakan <a href="{{ route('categories.create') }}">tambah kategori</a> terlebih dahulu.
        </div>
    @else
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="nama" class="form-label">Nama Produk <span style="color: red;">*</span></label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" 
                           value="{{ old('nama') }}" placeholder="Masukkan nama produk" required>
                    @error('nama')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id" class="form-label">Kategori <span style="color: red;">*</span></label>
                    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                          placeholder="Masukkan deskripsi produk (opsional)">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="harga" class="form-label">Harga (Rp) <span style="color: red;">*</span></label>
                    <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" 
                           value="{{ old('harga') }}" placeholder="Contoh: 15000" min="0" step="100" required>
                    @error('harga')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stok" class="form-label">Stok <span style="color: red;">*</span></label>
                    <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" 
                           value="{{ old('stok', 0) }}" placeholder="Contoh: 100" min="0" required>
                    @error('stok')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="satuan" class="form-label">Satuan <span style="color: red;">*</span></label>
                    <select name="satuan" id="satuan" class="form-select @error('satuan') is-invalid @enderror" required>
                        <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>pcs</option>
                        <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>kg</option>
                        <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>liter</option>
                        <option value="bungkus" {{ old('satuan') == 'bungkus' ? 'selected' : '' }}>bungkus</option>
                        <option value="botol" {{ old('satuan') == 'botol' ? 'selected' : '' }}>botol</option>
                        <option value="kaleng" {{ old('satuan') == 'kaleng' ? 'selected' : '' }}>kaleng</option>
                        <option value="sachet" {{ old('satuan') == 'sachet' ? 'selected' : '' }}>sachet</option>
                        <option value="dus" {{ old('satuan') == 'dus' ? 'selected' : '' }}>dus</option>
                    </select>
                    @error('satuan')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="gambar" class="form-label">Gambar Produk</label>
                <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" 
                       accept="image/jpeg,image/png,image/jpg,image/gif">
                <small style="color: #666;">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.</small>
                @error('gambar')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="aktif" id="aktif" class="form-check-input" value="1" 
                           {{ old('aktif', true) ? 'checked' : '' }}>
                    <label for="aktif" class="form-label" style="margin-bottom: 0;">Produk Aktif (Tersedia untuk dijual)</label>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">💾 Simpan Produk</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    @endif
</div>
@endsection
