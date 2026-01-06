@extends('layouts.app')

@section('title', 'Detail Transaksi - Toko Sembako Online')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">💳 Detail Transaksi #{{ $transaction->id }}</h1>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
        <div>
            <h3 style="color: #2e7d32; margin-bottom: 1rem;">Informasi Transaksi</h3>
            <table style="width: 100%;">
                <tr>
                    <td style="padding: 0.5rem 0; font-weight: bold; width: 150px;">No. Transaksi</td>
                    <td style="padding: 0.5rem 0;">: #{{ $transaction->id }}</td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem 0; font-weight: bold;">Tanggal</td>
                    <td style="padding: 0.5rem 0;">: {{ $transaction->created_at->format('d M Y, H:i') }}</td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem 0; font-weight: bold;">Status</td>
                    <td style="padding: 0.5rem 0;">: 
                        @if($transaction->status == 'selesai')
                            <span class="badge badge-success">Selesai</span>
                        @elseif($transaction->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @else
                            <span class="badge badge-danger">Batal</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div>
            <h3 style="color: #2e7d32; margin-bottom: 1rem;">Informasi Pembeli</h3>
            <table style="width: 100%;">
                <tr>
                    <td style="padding: 0.5rem 0; font-weight: bold; width: 150px;">Nama</td>
                    <td style="padding: 0.5rem 0;">: {{ $transaction->nama_pembeli }}</td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem 0; font-weight: bold;">No. Telepon</td>
                    <td style="padding: 0.5rem 0;">: {{ $transaction->no_telepon ?: '-' }}</td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem 0; font-weight: bold; vertical-align: top;">Alamat</td>
                    <td style="padding: 0.5rem 0;">: {{ $transaction->alamat ?: '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <hr style="margin: 1.5rem 0; border: none; border-top: 2px solid #e8f5e9;">

    <h3 style="color: #2e7d32; margin-bottom: 1rem;">Detail Produk</h3>
    
    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>{{ $transaction->product->nama }}</strong></td>
                <td><span class="badge badge-info">{{ $transaction->product->category->nama }}</span></td>
                <td class="price">Rp {{ number_format($transaction->product->harga, 0, ',', '.') }}</td>
                <td>{{ $transaction->jumlah }} {{ $transaction->product->satuan }}</td>
                <td class="price">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
            </tr>
        </tbody>
        <tfoot style="background: #f5f5f5; font-weight: bold;">
            <tr>
                <td colspan="4" style="text-align: right; padding: 1rem;">TOTAL BAYAR</td>
                <td class="price" style="font-size: 1.2rem; padding: 1rem;">
                    Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
    </table>

    <div style="display: flex; gap: 0.5rem; margin-top: 2rem;">
        @if($transaction->status == 'selesai')
            <form action="{{ route('transactions.update', $transaction) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="batal">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Batalkan transaksi ini? Stok akan dikembalikan.')">
                    🚫 Batalkan Transaksi
                </button>
            </form>
        @elseif($transaction->status == 'pending')
            <form action="{{ route('transactions.update', $transaction) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="selesai">
                <button type="submit" class="btn btn-primary" onclick="return confirm('Selesaikan transaksi ini?')">
                    ✅ Selesaikan Transaksi
                </button>
            </form>
            <form action="{{ route('transactions.update', $transaction) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="batal">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Batalkan transaksi ini?')">
                    🚫 Batalkan
                </button>
            </form>
        @elseif($transaction->status == 'batal')
            <form action="{{ route('transactions.update', $transaction) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="selesai">
                <button type="submit" class="btn btn-primary" onclick="return confirm('Aktifkan kembali transaksi ini? Stok akan dikurangi.')">
                    🔄 Aktifkan Kembali
                </button>
            </form>
        @endif

        <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus transaksi ini secara permanen?')">
                🗑️ Hapus Transaksi
            </button>
        </form>

        <button onclick="window.print()" class="btn btn-secondary">🖨️ Cetak</button>
    </div>
</div>

<style>
    @media print {
        .navbar, .btn, .card-header a, footer {
            display: none !important;
        }
        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
    }
</style>
@endsection
