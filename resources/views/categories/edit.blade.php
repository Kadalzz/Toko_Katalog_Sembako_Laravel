@extends('layouts.app')

@section('title', 'Edit Kategori - Toko Sembako Online')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📁 Edit Kategori</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama" class="form-label">Nama Kategori <span style="color: red;">*</span></label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" 
                   value="{{ old('nama', $category->nama) }}" placeholder="Masukkan nama kategori" required>
            @error('nama')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                      placeholder="Masukkan deskripsi kategori (opsional)">{{ old('deskripsi', $category->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="aktif" id="aktif" class="form-check-input" value="1" 
                       {{ old('aktif', $category->aktif) ? 'checked' : '' }}>
                <label for="aktif" class="form-label" style="margin-bottom: 0;">Kategori Aktif</label>
            </div>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">💾 Update Kategori</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
