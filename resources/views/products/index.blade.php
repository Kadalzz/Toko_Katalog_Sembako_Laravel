@extends('layouts.app')

@section('title', 'Daftar Produk - Toko Sembako Online')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📦 Daftar Produk Sembako</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
    </div>

    @if($products->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $index => $product)
                <tr>
                    <td>{{ $products->firstItem() + $index }}</td>
                    <td>
                        @if($product->gambar)
                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" class="product-image">
                        @else
                            <div class="product-image-placeholder">No Image</div>
                        @endif
                    </td>
                    <td><strong>{{ $product->nama }}</strong></td>
                    <td>
                        <span class="badge badge-info">{{ $product->category->nama }}</span>
                    </td>
                    <td class="price">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td>
                        @if($product->stok > 10)
                            <span class="badge badge-success">{{ $product->stok }} {{ $product->satuan }}</span>
                        @elseif($product->stok > 0)
                            <span class="badge badge-warning">{{ $product->stok }} {{ $product->satuan }}</span>
                        @else
                            <span class="badge badge-danger">Habis</span>
                        @endif
                    </td>
                    <td>
                        @if($product->aktif)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-secondary btn-sm">Detail</a>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $products->links() }}
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">📦</div>
            <h3>Belum Ada Produk</h3>
            <p>Silakan tambahkan produk terlebih dahulu.</p>
            <a href="{{ route('products.create') }}" class="btn btn-primary" style="margin-top: 1rem;">+ Tambah Produk</a>
        </div>
    @endif
</div>
@endsection
