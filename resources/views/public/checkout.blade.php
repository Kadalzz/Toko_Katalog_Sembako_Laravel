@extends('layouts.public')

@section('title', 'Checkout - ' . $product->nama)

@section('content')
<div style="margin-bottom: 1rem;">
    <a href="{{ route('public.show', $product->id) }}" style="color: #2e7d32; text-decoration: none;">← Kembali ke Produk</a>
</div>

<div style="display: grid; grid-template-columns: 1fr 400px; gap: 2rem;">
    <!-- Form Checkout -->
    <div class="card">
        <h2 style="color: #2e7d32; margin-bottom: 1.5rem;">📝 Form Pemesanan</h2>
        
        <form action="{{ route('public.order') }}" method="POST" id="checkoutForm">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="form-group">
                <label for="nama_pembeli" class="form-label">Nama Lengkap <span style="color: red;">*</span></label>
                <input type="text" name="nama_pembeli" id="nama_pembeli" 
                       class="form-control @error('nama_pembeli') is-invalid @enderror" 
                       value="{{ old('nama_pembeli') }}" 
                       placeholder="Masukkan nama lengkap Anda" required>
                @error('nama_pembeli')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_telepon" class="form-label">No. Telepon / WhatsApp <span style="color: red;">*</span></label>
                <input type="text" name="no_telepon" id="no_telepon" 
                       class="form-control @error('no_telepon') is-invalid @enderror" 
                       value="{{ old('no_telepon') }}" 
                       placeholder="08xxxxxxxxxx" required>
                @error('no_telepon')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat" class="form-label">Alamat Lengkap <span style="color: red;">*</span></label>
                <textarea name="alamat" id="alamat" 
                          class="form-control @error('alamat') is-invalid @enderror" 
                          rows="4" 
                          placeholder="Masukkan alamat lengkap untuk pengiriman" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah" class="form-label">Jumlah <span style="color: red;">*</span></label>
                <input type="number" name="jumlah" id="jumlah" 
                       class="form-control @error('jumlah') is-invalid @enderror" 
                       value="{{ old('jumlah', 1) }}" 
                       min="1" max="{{ $product->stok }}" required>
                <small style="color: #666;">Stok tersedia: {{ $product->stok }} {{ $product->satuan }}</small>
                @error('jumlah')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div style="background: #e8f5e9; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
                <p style="color: #2e7d32; margin: 0;">
                    <strong>💡 Catatan:</strong> Pesanan Anda akan segera diproses setelah konfirmasi. Kami akan menghubungi Anda melalui WhatsApp untuk konfirmasi pembayaran dan pengiriman.
                </p>
            </div>

            <button type="submit" class="btn btn-success" style="font-size: 1.1rem; padding: 1rem 2rem; width: 100%;">
                ✅ Kirim Pesanan
            </button>
        </form>
    </div>

    <!-- Order Summary -->
    <div>
        <div class="card">
            <h3 style="color: #2e7d32; margin-bottom: 1rem;">📋 Ringkasan Pesanan</h3>
            
            <div style="display: flex; gap: 1rem; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 2px solid #e0e0e0;">
                @if($product->gambar)
                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" 
                         style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                @else
                    <div style="width: 80px; height: 80px; background: #e0e0e0; border-radius: 5px; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                        📦
                    </div>
                @endif
                <div>
                    <div style="font-weight: bold; margin-bottom: 0.25rem;">{{ $product->nama }}</div>
                    <div style="color: #666; font-size: 0.9rem;">{{ $product->category->nama }}</div>
                </div>
            </div>

            <table style="width: 100%; margin-bottom: 1rem;">
                <tr>
                    <td style="padding: 0.5rem 0; color: #666;">Harga Satuan</td>
                    <td style="padding: 0.5rem 0; text-align: right; font-weight: bold;">
                        <span id="unitPrice">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem 0; color: #666;">Jumlah</td>
                    <td style="padding: 0.5rem 0; text-align: right; font-weight: bold;">
                        <span id="quantity">1</span> {{ $product->satuan }}
                    </td>
                </tr>
                <tr style="border-top: 2px solid #2e7d32;">
                    <td style="padding: 1rem 0 0 0; font-size: 1.2rem; font-weight: bold; color: #2e7d32;">Total</td>
                    <td style="padding: 1rem 0 0 0; text-align: right; font-size: 1.4rem; font-weight: bold; color: #2e7d32;">
                        <span id="totalPrice">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card" style="background: #fff3e0; border: 2px solid #ff9800;">
            <h4 style="color: #ef6c00; margin-bottom: 0.5rem;">⚠️ Penting!</h4>
            <ul style="color: #666; margin: 0; padding-left: 1.5rem;">
                <li style="margin-bottom: 0.5rem;">Pastikan data Anda benar</li>
                <li style="margin-bottom: 0.5rem;">Nomor WhatsApp aktif</li>
                <li style="margin-bottom: 0.5rem;">Alamat lengkap dan jelas</li>
                <li>Pesanan akan diproses H+1</li>
            </ul>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jumlahInput = document.getElementById('jumlah');
        const quantity = document.getElementById('quantity');
        const totalPrice = document.getElementById('totalPrice');
        const unitPrice = {{ $product->harga }};

        function formatRupiah(number) {
            return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function updateSummary() {
            const qty = parseInt(jumlahInput.value) || 1;
            quantity.textContent = qty;
            totalPrice.textContent = formatRupiah(unitPrice * qty);
        }

        jumlahInput.addEventListener('input', updateSummary);
    });
</script>

<style>
    @media (max-width: 768px) {
        body > div:first-of-type > div {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
