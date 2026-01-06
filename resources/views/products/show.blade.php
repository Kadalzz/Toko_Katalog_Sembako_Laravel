@extends('layouts.app')

@section('title', 'Detail Produk - Toko Sembako Online')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📦 Detail Produk</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <div style="display: grid; grid-template-columns: 200px 1fr; gap: 2rem; margin-bottom: 2rem;">
        <div>
            @if($product->gambar)
                <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" 
                     style="width: 100%; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            @else
                <div style="width: 100%; height: 200px; background: #e0e0e0; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #999;">
                    No Image
                </div>
            @endif
        </div>
        <div>
            <h2 style="margin-bottom: 0.5rem; color: #333;">{{ $product->nama }}</h2>
            <p class="price" style="font-size: 1.5rem; margin-bottom: 1rem;">Rp {{ number_format($product->harga, 0, ',', '.') }} / {{ $product->satuan }}</p>
            
            <table style="width: 100%; max-width: 400px;">
                <tr>
                    <td style="padding: 0.5rem 0; font-weight: bold; width: 120px;">Kategori</td>
                    <td style="padding: 0.5rem 0;">: 
                        <a href="{{ route('categories.show', $product->category) }}" class="badge badge-info" style="text-decoration: none;">
                            {{ $product->category->nama }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem 0; font-weight: bold;">Stok</td>
                    <td style="padding: 0.5rem 0;">: 
                        @if($product->stok > 10)
                            <span class="badge badge-success">{{ $product->stok }} {{ $product->satuan }}</span>
                        @elseif($product->stok > 0)
                            <span class="badge badge-warning">{{ $product->stok }} {{ $product->satuan }}</span>
                        @else
                            <span class="badge badge-danger">Habis</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem 0; font-weight: bold;">Status</td>
                    <td style="padding: 0.5rem 0;">: 
                        @if($product->aktif)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Nonaktif</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem 0; font-weight: bold;">Dibuat</td>
                    <td style="padding: 0.5rem 0;">: {{ $product->created_at->format('d M Y, H:i') }}</td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem 0; font-weight: bold;">Diperbarui</td>
                    <td style="padding: 0.5rem 0;">: {{ $product->updated_at->format('d M Y, H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>

    @if($product->deskripsi)
        <div style="margin-bottom: 2rem; padding: 1rem; background: #f5f5f5; border-radius: 5px;">
            <h3 style="color: #2e7d32; margin-bottom: 0.5rem;">Deskripsi</h3>
            <p>{{ $product->deskripsi }}</p>
        </div>
    @endif

    <div style="display: flex; gap: 0.5rem; margin-bottom: 2rem;">
        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">✏️ Edit</a>
        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
        </form>
    </div>

    <hr style="margin: 1.5rem 0; border: none; border-top: 2px solid #e8f5e9;">

    <h2 style="color: #2e7d32; margin-bottom: 1rem;">📋 Riwayat Transaksi</h2>

    @if($product->transactions->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Pembeli</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product->transactions as $index => $transaction)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                    <td>{{ $transaction->nama_pembeli }}</td>
                    <td>{{ $transaction->jumlah }} {{ $product->satuan }}</td>
                    <td class="price">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                    <td>
                        @if($transaction->status == 'selesai')
                            <span class="badge badge-success">Selesai</span>
                        @elseif($transaction->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @else
                            <span class="badge badge-danger">Batal</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state" style="padding: 2rem;">
            <p>Belum ada transaksi untuk produk ini.</p>
        </div>
    @endif
</div>

<style>
    @media (max-width: 768px) {
        .card > div:first-of-type {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
