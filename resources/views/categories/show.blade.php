@extends('layouts.app')

@section('title', 'Detail Kategori - Toko Sembako Online')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📁 Detail Kategori</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <div style="margin-bottom: 2rem;">
        <table style="width: 100%; max-width: 500px;">
            <tr>
                <td style="padding: 0.5rem 0; font-weight: bold; width: 150px;">Nama Kategori</td>
                <td style="padding: 0.5rem 0;">: {{ $category->nama }}</td>
            </tr>
            <tr>
                <td style="padding: 0.5rem 0; font-weight: bold;">Deskripsi</td>
                <td style="padding: 0.5rem 0;">: {{ $category->deskripsi ?: '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 0.5rem 0; font-weight: bold;">Status</td>
                <td style="padding: 0.5rem 0;">: 
                    @if($category->aktif)
                        <span class="badge badge-success">Aktif</span>
                    @else
                        <span class="badge badge-danger">Nonaktif</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="padding: 0.5rem 0; font-weight: bold;">Jumlah Produk</td>
                <td style="padding: 0.5rem 0;">: {{ $category->products->count() }} produk</td>
            </tr>
            <tr>
                <td style="padding: 0.5rem 0; font-weight: bold;">Dibuat</td>
                <td style="padding: 0.5rem 0;">: {{ $category->created_at->format('d M Y, H:i') }}</td>
            </tr>
            <tr>
                <td style="padding: 0.5rem 0; font-weight: bold;">Diperbarui</td>
                <td style="padding: 0.5rem 0;">: {{ $category->updated_at->format('d M Y, H:i') }}</td>
            </tr>
        </table>
    </div>

    <div style="display: flex; gap: 0.5rem; margin-bottom: 2rem;">
        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">✏️ Edit</a>
        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
        </form>
    </div>

    <hr style="margin: 1.5rem 0; border: none; border-top: 2px solid #e8f5e9;">

    <h2 style="color: #2e7d32; margin-bottom: 1rem;">📦 Produk dalam Kategori Ini</h2>

    @if($category->products->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category->products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($product->gambar)
                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" class="product-image">
                        @else
                            <div class="product-image-placeholder">No Image</div>
                        @endif
                    </td>
                    <td><strong>{{ $product->nama }}</strong></td>
                    <td class="price">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td>{{ $product->stok }} {{ $product->satuan }}</td>
                    <td>
                        @if($product->aktif)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-secondary btn-sm">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state" style="padding: 2rem;">
            <p>Belum ada produk dalam kategori ini.</p>
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm" style="margin-top: 0.5rem;">+ Tambah Produk</a>
        </div>
    @endif
</div>
@endsection
