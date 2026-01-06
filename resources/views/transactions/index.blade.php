@extends('layouts.app')

@section('title', 'Daftar Transaksi - Toko Sembako Online')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">💳 Daftar Transaksi Penjualan</h1>
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">+ Transaksi Baru</a>
    </div>

    <!-- Filter -->
    <form method="GET" action="{{ route('transactions.index') }}" style="margin-bottom: 1.5rem;">
        <div class="form-row">
            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="form-group" style="display: flex; align-items: flex-end;">
                <button type="submit" class="btn btn-primary" style="margin-right: 0.5rem;">🔍 Filter</button>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    @if($transactions->count() > 0)
        <!-- Summary -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
            <div style="padding: 1rem; background: #e8f5e9; border-radius: 5px;">
                <div style="font-size: 0.9rem; color: #666;">Total Transaksi</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: #2e7d32;">{{ $transactions->total() }}</div>
            </div>
            <div style="padding: 1rem; background: #e3f2fd; border-radius: 5px;">
                <div style="font-size: 0.9rem; color: #666;">Total Pendapatan</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: #1565c0;">
                    Rp {{ number_format($transactions->sum('total_harga'), 0, ',', '.') }}
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Pembeli</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $index => $transaction)
                <tr>
                    <td>{{ $transactions->firstItem() + $index }}</td>
                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <strong>{{ $transaction->product->nama }}</strong>
                        <br>
                        <small class="badge badge-info">{{ $transaction->product->category->nama }}</small>
                    </td>
                    <td>{{ $transaction->nama_pembeli }}</td>
                    <td>{{ $transaction->jumlah }} {{ $transaction->product->satuan }}</td>
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
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-secondary btn-sm">Detail</a>
                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
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
            {{ $transactions->links() }}
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">💳</div>
            <h3>Belum Ada Transaksi</h3>
            <p>Mulai transaksi penjualan pertama Anda.</p>
            <a href="{{ route('transactions.create') }}" class="btn btn-primary" style="margin-top: 1rem;">+ Transaksi Baru</a>
        </div>
    @endif
</div>
@endsection
