@extends('layouts.app')

@section('title', 'Edit Produk - Toko Sembako Online')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📦 Edit Produk</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label for="nama" class="form-label">Nama Produk <span style="color: red;">*</span></label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" 
                       value="{{ old('nama', $product->nama) }}" placeholder="Masukkan nama produk" required>
                @error('nama')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id" class="form-label">Kategori <span style="color: red;">*</span></label>
                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                      placeholder="Masukkan deskripsi produk (opsional)">{{ old('deskripsi', $product->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="harga" class="form-label">Harga (Rp) <span style="color: red;">*</span></label>
                <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" 
                       value="{{ old('harga', $product->harga) }}" placeholder="Contoh: 15000" min="0" step="100" required>
                @error('harga')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="stok" class="form-label">Stok <span style="color: red;">*</span></label>
                <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" 
                       value="{{ old('stok', $product->stok) }}" placeholder="Contoh: 100" min="0" required>
                @error('stok')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="satuan" class="form-label">Satuan <span style="color: red;">*</span></label>
                <select name="satuan" id="satuan" class="form-select @error('satuan') is-invalid @enderror" required>
                    <option value="pcs" {{ old('satuan', $product->satuan) == 'pcs' ? 'selected' : '' }}>pcs</option>
                    <option value="kg" {{ old('satuan', $product->satuan) == 'kg' ? 'selected' : '' }}>kg</option>
                    <option value="liter" {{ old('satuan', $product->satuan) == 'liter' ? 'selected' : '' }}>liter</option>
                    <option value="bungkus" {{ old('satuan', $product->satuan) == 'bungkus' ? 'selected' : '' }}>bungkus</option>
                    <option value="botol" {{ old('satuan', $product->satuan) == 'botol' ? 'selected' : '' }}>botol</option>
                    <option value="kaleng" {{ old('satuan', $product->satuan) == 'kaleng' ? 'selected' : '' }}>kaleng</option>
                    <option value="sachet" {{ old('satuan', $product->satuan) == 'sachet' ? 'selected' : '' }}>sachet</option>
                    <option value="dus" {{ old('satuan', $product->satuan) == 'dus' ? 'selected' : '' }}>dus</option>
                </select>
                @error('satuan')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="gambar" class="form-label">Gambar Produk</label>
            @if($product->gambar)
                <div style="margin-bottom: 0.5rem;">
                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" 
                         style="max-width: 150px; border-radius: 5px; border: 1px solid #e0e0e0;">
                    <p style="font-size: 0.85rem; color: #666; margin-top: 0.25rem;">Gambar saat ini</p>
                </div>
            @endif
            <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" 
                   accept="image/jpeg,image/png,image/jpg,image/gif">
            <small style="color: #666;">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
            @error('gambar')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="aktif" id="aktif" class="form-check-input" value="1" 
                       {{ old('aktif', $product->aktif) ? 'checked' : '' }}>
                <label for="aktif" class="form-label" style="margin-bottom: 0;">Produk Aktif (Tersedia untuk dijual)</label>
            </div>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">💾 Update Produk</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
