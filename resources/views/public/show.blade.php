@extends('layouts.public')

@section('title', $product->nama . ' - Toko Sembako Online')

@section('content')
<div style="margin-bottom: 1rem;">
    <a href="{{ route('public.index') }}" style="color: #2e7d32; text-decoration: none;">← Kembali ke Katalog</a>
</div>

<div class="card">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
        <!-- Product Image -->
        <div>
            @if($product->gambar)
                @if(str_starts_with($product->gambar, 'http'))
                    <img src="{{ $product->gambar }}" alt="{{ $product->nama }}" 
                         style="width: 100%; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);"
                         onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div style="display:none; width: 100%; height: 400px; background: linear-gradient(135deg, #e0e0e0 0%, #bdbdbd 100%); border-radius: 10px; align-items: center; justify-content: center; font-size: 5rem;">
                        📦
                    </div>
                @else
                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" 
                         style="width: 100%; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);"
                         onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div style="display:none; width: 100%; height: 400px; background: linear-gradient(135deg, #e0e0e0 0%, #bdbdbd 100%); border-radius: 10px; align-items: center; justify-content: center; font-size: 5rem;">
                        📦
                    </div>
                @endif
            @else
                <div style="width: 100%; height: 400px; background: linear-gradient(135deg, #e0e0e0 0%, #bdbdbd 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 5rem;">
                    📦
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div>
            <span class="badge badge-info" style="font-size: 0.9rem;">{{ $product->category->nama }}</span>
            <h1 style="color: #333; margin: 1rem 0;">{{ $product->nama }}</h1>
            
            <div style="font-size: 2rem; font-weight: bold; color: #2e7d32; margin-bottom: 1rem;">
                Rp {{ number_format($product->harga, 0, ',', '.') }} 
                <span style="font-size: 1rem; color: #666; font-weight: normal;">/ {{ $product->satuan }}</span>
            </div>

            <div style="margin-bottom: 1.5rem;">
                @if($product->stok > 10)
                    <span class="badge badge-success" style="font-size: 1rem; padding: 0.5rem 1rem;">
                        ✅ Stok Tersedia: {{ $product->stok }} {{ $product->satuan }}
                    </span>
                @elseif($product->stok > 0)
                    <span class="badge badge-warning" style="font-size: 1rem; padding: 0.5rem 1rem;">
                        ⚠️ Stok Terbatas: {{ $product->stok }} {{ $product->satuan }}
                    </span>
                @else
                    <span class="badge" style="background: #ffebee; color: #c62828; font-size: 1rem; padding: 0.5rem 1rem;">
                        ❌ Stok Habis
                    </span>
                @endif
            </div>

            @if($product->deskripsi)
                <div style="background: #f5f5f5; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem;">
                    <h3 style="color: #2e7d32; margin-bottom: 0.5rem;">Deskripsi Produk</h3>
                    <p style="color: #666;">{{ $product->deskripsi }}</p>
                </div>
            @endif

            @if($product->stok > 0)
                <a href="{{ route('public.checkout', $product->id) }}" class="btn btn-success" style="font-size: 1.2rem; padding: 1rem 2rem; width: 100%;">
                    🛍️ Beli Sekarang
                </a>
            @else
                <button class="btn" style="background: #e0e0e0; color: #999; font-size: 1.2rem; padding: 1rem 2rem; width: 100%; cursor: not-allowed;" disabled>
                    Stok Habis
                </button>
            @endif

            <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 2px solid #e0e0e0;">
                <h4 style="color: #666; margin-bottom: 0.5rem;">Informasi Tambahan:</h4>
                <ul style="color: #666; list-style: none; padding: 0;">
                    <li style="padding: 0.25rem 0;">✓ Produk asli dan berkualitas</li>
                    <li style="padding: 0.25rem 0;">✓ Pengiriman cepat</li>
                    <li style="padding: 0.25rem 0;">✓ Harga sudah termasuk PPN</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@if($relatedProducts->count() > 0)
    <div style="margin-top: 3rem;">
        <h2 style="color: #2e7d32; margin-bottom: 1.5rem;">Produk Terkait</h2>
        <div class="product-grid">
            @foreach($relatedProducts as $related)
                <div class="product-card">
                    <a href="{{ route('public.show', $related->id) }}" style="text-decoration: none; color: inherit;">
                        @if($related->gambar)
                            <img src="{{ asset('storage/' . $related->gambar) }}" alt="{{ $related->nama }}" class="product-image">
                        @else
                            <div class="product-image-placeholder">📦</div>
                        @endif
                        
                        <div class="product-body">
                            <span class="product-category">{{ $related->category->nama }}</span>
                            <div class="product-name">{{ $related->nama }}</div>
                            <div class="product-price">Rp {{ number_format($related->harga, 0, ',', '.') }}</div>
                            <div class="product-stock">
                                <span class="badge badge-success">Stok: {{ $related->stok }} {{ $related->satuan }}</span>
                            </div>
                        </div>
                    </a>
                    <div style="padding: 0 1rem 1rem;">
                        <a href="{{ route('public.show', $related->id) }}" class="btn btn-success btn-block">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

<style>
    @media (max-width: 768px) {
        .card > div {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
