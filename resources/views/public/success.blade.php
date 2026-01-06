@extends('layouts.public')

@section('title', 'Pesanan Berhasil')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <!-- Success Message -->
    <div style="text-align: center; padding: 2rem; background: linear-gradient(135deg, #2e7d32, #66bb6a); color: white; border-radius: 10px; margin-bottom: 2rem;">
        <div style="font-size: 4rem; margin-bottom: 1rem;">✅</div>
        <h1 style="margin: 0 0 0.5rem 0; font-size: 2rem;">Pesanan Berhasil Dibuat!</h1>
        <p style="margin: 0; font-size: 1.1rem;">Terima kasih atas pesanan Anda</p>
    </div>

    <!-- Transaction Details -->
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #e0e0e0;">
            <div>
                <h2 style="color: #2e7d32; margin: 0 0 0.25rem 0;">Detail Pesanan</h2>
                <p style="color: #666; margin: 0;">ID Transaksi: <strong>#{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</strong></p>
            </div>
            <div>
                <span class="badge" style="background: #ff9800; color: white; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem;">
                    📦 {{ ucfirst($transaction->status) }}
                </span>
            </div>
        </div>

        <div style="background: #f5f5f5; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
            <div style="display: flex; gap: 1rem; align-items: center;">
                @if($transaction->product->gambar)
                    <img src="{{ asset('storage/' . $transaction->product->gambar) }}" alt="{{ $transaction->product->nama }}" 
                         style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                @else
                    <div style="width: 100px; height: 100px; background: #e0e0e0; border-radius: 5px; display: flex; align-items: center; justify-content: center; font-size: 3rem;">
                        📦
                    </div>
                @endif
                <div style="flex: 1;">
                    <h3 style="margin: 0 0 0.5rem 0;">{{ $transaction->product->nama }}</h3>
                    <p style="color: #666; margin: 0 0 0.5rem 0;">{{ $transaction->product->category->nama }}</p>
                    <p style="margin: 0;">
                        <strong>{{ $transaction->jumlah }} {{ $transaction->product->satuan }}</strong> × 
                        <strong>Rp {{ number_format($transaction->product->harga, 0, ',', '.') }}</strong>
                    </p>
                </div>
            </div>
        </div>

        <table style="width: 100%; margin-bottom: 1.5rem;">
            <tr>
                <td style="padding: 0.75rem; background: #fafafa; font-weight: bold;">Total Harga</td>
                <td style="padding: 0.75rem; background: #fafafa; text-align: right; font-size: 1.5rem; color: #2e7d32; font-weight: bold;">
                    Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}
                </td>
            </tr>
        </table>

        <h3 style="color: #2e7d32; margin: 0 0 1rem 0;">👤 Informasi Pembeli</h3>
        <table style="width: 100%; margin-bottom: 1.5rem;">
            <tr>
                <td style="padding: 0.5rem 0; color: #666; width: 150px;">Nama</td>
                <td style="padding: 0.5rem 0; font-weight: bold;">{{ $transaction->nama_pembeli }}</td>
            </tr>
            <tr>
                <td style="padding: 0.5rem 0; color: #666;">No. Telepon</td>
                <td style="padding: 0.5rem 0; font-weight: bold;">{{ $transaction->no_telepon }}</td>
            </tr>
            <tr>
                <td style="padding: 0.5rem 0; color: #666; vertical-align: top;">Alamat</td>
                <td style="padding: 0.5rem 0;">{{ $transaction->alamat }}</td>
            </tr>
            <tr>
                <td style="padding: 0.5rem 0; color: #666;">Tanggal Pesanan</td>
                <td style="padding: 0.5rem 0;">{{ $transaction->created_at->format('d F Y, H:i') }} WIB</td>
            </tr>
        </table>

        <div style="background: #e3f2fd; padding: 1rem; border-left: 4px solid #2196f3; border-radius: 5px; margin-bottom: 1rem;">
            <h4 style="color: #1976d2; margin: 0 0 0.5rem 0;">📱 Langkah Selanjutnya:</h4>
            <ol style="color: #666; margin: 0; padding-left: 1.5rem;">
                <li style="margin-bottom: 0.5rem;">Tim kami akan menghubungi Anda melalui WhatsApp</li>
                <li style="margin-bottom: 0.5rem;">Konfirmasi metode pembayaran dan pengiriman</li>
                <li style="margin-bottom: 0.5rem;">Setelah pembayaran dikonfirmasi, pesanan akan dikirim</li>
                <li>Estimasi pengiriman: 1-3 hari kerja</li>
            </ol>
        </div>

        <div style="background: #fff3e0; padding: 1rem; border-left: 4px solid #ff9800; border-radius: 5px; margin-bottom: 1.5rem;">
            <p style="color: #ef6c00; margin: 0;">
                <strong>⚠️ Penting:</strong> Simpan ID Transaksi Anda untuk memudahkan komunikasi dengan customer service kami.
            </p>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('public.index') }}" class="btn" style="background: #2e7d32; color: white; text-decoration: none; padding: 0.75rem 2rem; border-radius: 5px; display: inline-block;">
                🏠 Kembali ke Beranda
            </a>
            <button onclick="window.print()" class="btn" style="background: #1976d2; color: white; border: none; padding: 0.75rem 2rem; border-radius: 5px; cursor: pointer;">
                🖨️ Cetak Pesanan
            </button>
            <a href="https://wa.me/62821423882292?text=Halo,%20saya%20ingin%20konfirmasi%20pesanan%20dengan%20ID%20%23{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}" 
               target="_blank" 
               class="btn" 
               style="background: #25d366; color: white; text-decoration: none; padding: 0.75rem 2rem; border-radius: 5px; display: inline-block;">
                💬 Hubungi WhatsApp
            </a>
        </div>
    </div>

    <!-- Thank You Message -->
    <div style="text-align: center; margin-top: 2rem; color: #666;">
        <p style="font-size: 1.1rem; margin: 0;">
            Terima kasih telah berbelanja di <strong style="color: #2e7d32;">Toko Sembako Online</strong>! 🛒
        </p>
        <p style="margin: 0.5rem 0 0 0;">Kami akan memberikan pelayanan terbaik untuk Anda</p>
    </div>
</div>

<style>
    @media print {
        .btn { display: none !important; }
        nav, footer { display: none !important; }
    }
</style>
@endsection
