@extends('layouts.public')

@section('title', 'Toko Sembako Online - Belanja Kebutuhan Sehari-hari')

@section('content')
<!-- Hero Banner -->
<div class="hero-banner">
    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=1400&h=450&fit=crop" alt="Sembako Berkualitas">
    <div class="hero-content">
        <h1>Belanja Sembako Jadi Lebih Mudah</h1>
        <p>Kebutuhan sehari-hari lengkap dengan harga terjangkau dan kualitas terbaik</p>
        <a href="#produk" class="hero-btn">Lihat Produk</a>
    </div>
</div>

<!-- Featured Categories -->
<div class="featured-grid">
    @foreach($categories->take(4) as $index => $category)
        <div class="featured-card">
            <img src="https://images.unsplash.com/photo-{{ ['1542838132-92c53300491e', '1588964895597-cfccd6e2dbf9', '1604719312566-878d9b3cf2c', '1556910103-1c02745aae4d'][$index % 4] }}?w=400&h=200&fit=crop" alt="{{ $category->nama }}" class="featured-card-image">
            <div class="featured-card-content">
                <h3>{{ $category->nama }}</h3>
                <a href="{{ route('public.index', ['category' => $category->id]) }}" class="featured-btn">Lihat Produk</a>
            </div>
        </div>
    @endforeach
</div>

<!-- Category Icons -->
<div id="kategori" class="category-section">
    <h2>Kategori Produk</h2>
    <div class="category-grid">
        @php
            $icons = ['🥬', '🍚', '🥫', '🧊', '🥤', '🧴'];
            $displayedCategories = $categories->take(6);
        @endphp
        @foreach($displayedCategories as $index => $category)
            <a href="{{ route('public.index', ['category' => $category->id]) }}" class="category-item">
                <div class="category-icon">{{ $icons[$index % 6] }}</div>
                <div class="category-name">{{ $category->nama }}</div>
            </a>
        @endforeach
    </div>
</div>

<!-- Search & Filter -->
<div id="produk" class="search-filter">
    <form method="GET" action="{{ route('public.index') }}">
        <input type="text" name="search" class="form-control" placeholder="🔍 Cari produk..." value="{{ request('search') }}">
        <select name="category" class="form-select">
            <option value="">📁 Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->nama }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
</div>

<!-- Product Grid -->
@if($products->count() > 0)
    <div class="product-grid">
        @foreach($products as $product)
            <div class="product-card">
                <a href="{{ route('public.show', $product->id) }}" style="text-decoration: none; color: inherit;">
                    @if($product->gambar)
                        @if(str_starts_with($product->gambar, 'http'))
                            <img src="{{ $product->gambar }}" alt="{{ $product->nama }}" class="product-image" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'product-image-placeholder\'>📦</div>';">
                        @else
                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" class="product-image" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'product-image-placeholder\'>📦</div>';">
                        @endif
                    @else
                        <div class="product-image-placeholder">📦</div>
                    @endif
                    
                    <div class="product-body">
                        <span class="product-category">{{ $product->category->nama }}</span>
                        <div class="product-name">{{ $product->nama }}</div>
                        <div class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                        <div class="product-stock">
                            @if($product->stok > 10)
                                <span class="badge badge-success">Stok: {{ $product->stok }} {{ $product->satuan }}</span>
                            @elseif($product->stok > 0)
                                <span class="badge badge-warning">Stok: {{ $product->stok }} {{ $product->satuan }}</span>
                            @else
                                <span class="badge" style="background: #ffebee; color: #c62828;">Habis</span>
                            @endif
                        </div>
                    </div>
                </a>
                <div style="padding: 0 1rem 1rem;">
                    <a href="{{ route('public.show', $product->id) }}" class="btn btn-success btn-block">
                        🛍️ Lihat Detail & Beli
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $products->appends(request()->query())->links() }}
    </div>
@else
    <div class="card">
        <div class="empty-state">
            <div class="empty-state-icon">📦</div>
            <h3>Produk Tidak Ditemukan</h3>
            <p>Maaf, produk yang Anda cari tidak tersedia.</p>
            <a href="{{ route('public.index') }}" class="btn btn-primary" style="margin-top: 1rem;">Lihat Semua Produk</a>
        </div>
    </div>
@endif

<!-- Info Section -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 4rem;">
    <div class="card" style="text-align: center; border: 2px solid #e8f5e9;">
        <div style="font-size: 4rem; margin-bottom: 1rem;">🚚</div>
        <h3 style="color: #2e7d32; margin-bottom: 0.75rem; font-size: 1.3rem;">Pengiriman Cepat</h3>
        <p style="color: #666; font-size: 1rem;">Pesanan Anda diproses segera dan dikirim dengan cepat ke alamat tujuan</p>
    </div>
    <div class="card" style="text-align: center; border: 2px solid #e8f5e9;">
        <div style="font-size: 4rem; margin-bottom: 1rem;">💰</div>
        <h3 style="color: #2e7d32; margin-bottom: 0.75rem; font-size: 1.3rem;">Harga Terjangkau</h3>
        <p style="color: #666; font-size: 1rem;">Harga bersaing dan terjangkau untuk semua kalangan dengan kualitas terjamin</p>
    </div>
    <div class="card" style="text-align: center; border: 2px solid #e8f5e9;">
        <div style="font-size: 4rem; margin-bottom: 1rem;">✅</div>
        <h3 style="color: #2e7d32; margin-bottom: 0.75rem; font-size: 1.3rem;">Produk Berkualitas</h3>
        <p style="color: #666; font-size: 1rem;">Semua produk terjamin kualitasnya dan dipilih dari supplier terpercaya</p>
    </div>
</div>
@endsection
