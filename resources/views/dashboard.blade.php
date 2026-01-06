@extends('layouts.app')

@section('title', 'Dashboard - Toko Sembako Online')

@section('content')
<!-- Header -->
<div style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <h1 style="color: #2e7d32; margin: 0;">📊 Dashboard Toko Sembako</h1>
    
    <!-- Filter Periode -->
    <form method="GET" action="{{ route('dashboard') }}" style="display: flex; gap: 0.5rem;">
        <select name="periode" class="form-select" onchange="this.form.submit()" style="width: auto;">
            <option value="hari_ini" {{ $periode == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
            <option value="minggu_ini" {{ $periode == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
            <option value="bulan_ini" {{ $periode == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
            <option value="tahun_ini" {{ $periode == 'tahun_ini' ? 'selected' : '' }}>Tahun Ini</option>
        </select>
    </form>
</div>

<!-- Statistik Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
    <div class="card" style="background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%); color: white;">
        <div style="font-size: 0.9rem; opacity: 0.9;">Total Pendapatan</div>
        <div style="font-size: 1.8rem; font-weight: bold; margin: 0.5rem 0;">
            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
        </div>
        <div style="font-size: 0.85rem; opacity: 0.8;">{{ ucfirst(str_replace('_', ' ', $periode)) }}</div>
    </div>

    <div class="card" style="background: linear-gradient(135deg, #1976d2 0%, #0d47a1 100%); color: white;">
        <div style="font-size: 0.9rem; opacity: 0.9;">Total Transaksi</div>
        <div style="font-size: 1.8rem; font-weight: bold; margin: 0.5rem 0;">{{ $totalTransaksi }}</div>
        <div style="font-size: 0.85rem; opacity: 0.8;">Transaksi berhasil</div>
    </div>

    <div class="card" style="background: linear-gradient(135deg, #f57c00 0%, #e65100 100%); color: white;">
        <div style="font-size: 0.9rem; opacity: 0.9;">Produk Terjual</div>
        <div style="font-size: 1.8rem; font-weight: bold; margin: 0.5rem 0;">{{ $totalProdukTerjual }}</div>
        <div style="font-size: 0.85rem; opacity: 0.8;">Total item terjual</div>
    </div>

    <div class="card" style="background: linear-gradient(135deg, #7b1fa2 0%, #4a148c 100%); color: white;">
        <div style="font-size: 0.9rem; opacity: 0.9;">Rata-rata Transaksi</div>
        <div style="font-size: 1.8rem; font-weight: bold; margin: 0.5rem 0;">
            Rp {{ $totalTransaksi > 0 ? number_format($totalPendapatan / $totalTransaksi, 0, ',', '.') : '0' }}
        </div>
        <div style="font-size: 0.85rem; opacity: 0.8;">Per transaksi</div>
    </div>
</div>

<!-- Info Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="color: #666; font-size: 0.9rem;">Total Kategori</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: #2e7d32;">{{ $totalKategori }}</div>
            </div>
            <div style="font-size: 2rem;">📁</div>
        </div>
    </div>

    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="color: #666; font-size: 0.9rem;">Total Produk</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: #1976d2;">{{ $totalProduk }}</div>
            </div>
            <div style="font-size: 2rem;">📦</div>
        </div>
    </div>

    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="color: #666; font-size: 0.9rem;">Stok Rendah</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: #f57c00;">{{ $produkStokRendah }}</div>
            </div>
            <div style="font-size: 2rem;">⚠️</div>
        </div>
    </div>

    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="color: #666; font-size: 0.9rem;">Stok Habis</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: #d32f2f;">{{ $produkHabis }}</div>
            </div>
            <div style="font-size: 2rem;">🚫</div>
        </div>
    </div>
</div>

<!-- Charts & Tables -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Produk Terlaris -->
    <div class="card">
        <h2 style="color: #2e7d32; margin-bottom: 1rem;">🏆 Produk Terlaris</h2>
        @if($produkTerlaris->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produkTerlaris as $item)
                    <tr>
                        <td><strong>{{ $item->product->nama }}</strong></td>
                        <td><span class="badge badge-info">{{ $item->product->category->nama }}</span></td>
                        <td><span class="badge badge-success">{{ $item->total_terjual }} {{ $item->product->satuan }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align: center; color: #999; padding: 2rem;">Belum ada data penjualan</p>
        @endif
    </div>

    <!-- Transaksi Terbaru -->
    <div class="card">
        <h2 style="color: #2e7d32; margin-bottom: 1rem;">📋 Transaksi Terbaru</h2>
        @if($transaksiTerbaru->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Produk</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksiTerbaru as $transaksi)
                    <tr>
                        <td style="white-space: nowrap;">{{ $transaksi->created_at->format('d/m H:i') }}</td>
                        <td>
                            <strong>{{ Str::limit($transaksi->product->nama, 20) }}</strong>
                            <br>
                            <small>{{ $transaksi->nama_pembeli }}</small>
                        </td>
                        <td class="price">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-sm" style="width: 100%; margin-top: 0.5rem;">
                Lihat Semua Transaksi
            </a>
        @else
            <p style="text-align: center; color: #999; padding: 2rem;">Belum ada transaksi</p>
        @endif
    </div>
</div>

<!-- Grafik Pendapatan -->
<div class="card">
    <h2 style="color: #2e7d32; margin-bottom: 1.5rem;">📈 Pendapatan 7 Hari Terakhir</h2>
    
    @if($pendapatanHarian->count() > 0)
        <div style="background: linear-gradient(180deg, #f5f5f5 0%, #ffffff 100%); padding: 2rem; border-radius: 10px; border: 1px solid #e0e0e0;">
            <!-- Chart Container -->
            <div style="display: flex; align-items: flex-end; gap: 1.5rem; height: 280px; padding: 1.5rem 1rem; border-bottom: 2px solid #2e7d32; position: relative;">
                @php
                    $maxPendapatan = $pendapatanHarian->max('total');
                    $dates = [];
                    for ($i = 6; $i >= 0; $i--) {
                        $dates[] = now()->subDays($i)->format('Y-m-d');
                    }
                @endphp
                @foreach($dates as $date)
                    @php
                        $item = $pendapatanHarian->firstWhere('tanggal', $date);
                        $total = $item ? $item->total : 0;
                        $height = $maxPendapatan > 0 ? ($total / $maxPendapatan) * 100 : 0;
                        $heightPx = $height > 0 ? max($height, 5) : 0;
                    @endphp
                    <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 0.5rem;">
                        <!-- Bar -->
                        <div style="width: 100%; height: 100%; display: flex; align-items: flex-end; justify-content: center;">
                            @if($total > 0)
                                <div style="width: 80%; background: linear-gradient(180deg, #4caf50 0%, #2e7d32 100%); height: {{ $heightPx }}%; border-radius: 8px 8px 0 0; box-shadow: 0 -2px 10px rgba(46, 125, 50, 0.3); transition: all 0.3s; cursor: pointer; position: relative;"
                                     onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 -4px 15px rgba(46, 125, 50, 0.5)'"
                                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 -2px 10px rgba(46, 125, 50, 0.3)'"
                                     title="Rp {{ number_format($total, 0, ',', '.') }}">
                                    <!-- Value Label on Bar -->
                                    <div style="position: absolute; top: -25px; left: 50%; transform: translateX(-50%); background: #2e7d32; color: white; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.7rem; font-weight: bold; white-space: nowrap; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                                        {{ $total >= 1000000 ? number_format($total / 1000000, 1) . 'jt' : number_format($total / 1000, 0) . 'k' }}
                                    </div>
                                </div>
                            @else
                                <div style="width: 80%; background: #e0e0e0; height: 5%; min-height: 3px; border-radius: 8px 8px 0 0;"></div>
                            @endif
                        </div>
                        <!-- Date Label -->
                        <div style="font-size: 0.8rem; color: #666; font-weight: 500; margin-top: 0.5rem;">
                            {{ \Carbon\Carbon::parse($date)->locale('id')->isoFormat('dd') }}<br>
                            <span style="font-size: 0.75rem; color: #999;">{{ \Carbon\Carbon::parse($date)->format('d/m') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Summary -->
            <div style="margin-top: 1.5rem; padding: 1rem; background: #e8f5e9; border-radius: 8px; display: flex; justify-content: space-around; flex-wrap: wrap; gap: 1rem;">
                <div style="text-align: center;">
                    <div style="font-size: 0.85rem; color: #666; margin-bottom: 0.25rem;">Total 7 Hari</div>
                    <div style="font-size: 1.3rem; font-weight: bold; color: #2e7d32;">
                        Rp {{ number_format($pendapatanHarian->sum('total'), 0, ',', '.') }}
                    </div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 0.85rem; color: #666; margin-bottom: 0.25rem;">Rata-rata Harian</div>
                    <div style="font-size: 1.3rem; font-weight: bold; color: #2e7d32;">
                        Rp {{ number_format($pendapatanHarian->avg('total'), 0, ',', '.') }}
                    </div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 0.85rem; color: #666; margin-bottom: 0.25rem;">Hari Tertinggi</div>
                    <div style="font-size: 1.3rem; font-weight: bold; color: #2e7d32;">
                        Rp {{ number_format($maxPendapatan, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
    @else
        <div style="text-align: center; color: #999; padding: 3rem; background: #f5f5f5; border-radius: 10px;">
            <div style="font-size: 3rem; margin-bottom: 1rem;">📊</div>
            <p style="margin: 0;">Belum ada data pendapatan</p>
        </div>
    @endif
</div>

<!-- Quick Actions -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 2rem;">
    <a href="{{ route('transactions.create') }}" class="btn btn-primary" style="padding: 1.5rem; text-align: center; text-decoration: none;">
        💳 Transaksi Baru
    </a>
    <a href="{{ route('products.create') }}" class="btn btn-primary" style="padding: 1.5rem; text-align: center; text-decoration: none;">
        📦 Tambah Produk
    </a>
    <a href="{{ route('categories.create') }}" class="btn btn-primary" style="padding: 1.5rem; text-align: center; text-decoration: none;">
        📁 Tambah Kategori
    </a>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary" style="padding: 1.5rem; text-align: center; text-decoration: none;">
        📋 Lihat Semua Transaksi
    </a>
</div>
@endsection
