@extends('layouts.app')

@section('title', 'Transaksi Baru - Toko Sembako Online')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">💳 Transaksi Penjualan Baru</h1>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    @if($products->count() == 0)
        <div class="alert alert-warning">
            ⚠️ Tidak ada produk tersedia untuk dijual. Silakan <a href="{{ route('products.create') }}">tambah produk</a> terlebih dahulu.
        </div>
    @else
        <form action="{{ route('transactions.store') }}" method="POST" id="transactionForm">
            @csrf

            <div class="form-group">
                <label for="product_id" class="form-label">Pilih Produk <span style="color: red;">*</span></label>
                <select name="product_id" id="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" 
                                data-price="{{ $product->harga }}" 
                                data-stock="{{ $product->stok }}"
                                data-satuan="{{ $product->satuan }}"
                                {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->nama }} - {{ $product->category->nama }} 
                            (Stok: {{ $product->stok }} {{ $product->satuan }}, 
                            Rp {{ number_format($product->harga, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="nama_pembeli" class="form-label">Nama Pembeli <span style="color: red;">*</span></label>
                    <input type="text" name="nama_pembeli" id="nama_pembeli" 
                           class="form-control @error('nama_pembeli') is-invalid @enderror" 
                           value="{{ old('nama_pembeli') }}" 
                           placeholder="Masukkan nama pembeli" required>
                    @error('nama_pembeli')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_telepon" class="form-label">No. Telepon</label>
                    <input type="text" name="no_telepon" id="no_telepon" 
                           class="form-control @error('no_telepon') is-invalid @enderror" 
                           value="{{ old('no_telepon') }}" 
                           placeholder="08xxxxxxxxxx">
                    @error('no_telepon')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="alamat" class="form-label">Alamat Pengiriman</label>
                <textarea name="alamat" id="alamat" 
                          class="form-control @error('alamat') is-invalid @enderror" 
                          placeholder="Masukkan alamat pengiriman (opsional)">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah" class="form-label">Jumlah <span style="color: red;">*</span></label>
                <input type="number" name="jumlah" id="jumlah" 
                       class="form-control @error('jumlah') is-invalid @enderror" 
                       value="{{ old('jumlah', 1) }}" 
                       min="1" required>
                <small id="stockInfo" style="color: #666;"></small>
                @error('jumlah')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Summary -->
            <div style="background: #f5f5f5; padding: 1.5rem; border-radius: 5px; margin: 1.5rem 0;">
                <h3 style="color: #2e7d32; margin-bottom: 1rem;">Ringkasan Transaksi</h3>
                <table style="width: 100%; max-width: 400px;">
                    <tr>
                        <td style="padding: 0.5rem 0; font-weight: bold;">Harga Satuan</td>
                        <td style="padding: 0.5rem 0; text-align: right;">
                            <span id="unitPrice" class="price">Rp 0</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0.5rem 0; font-weight: bold;">Jumlah</td>
                        <td style="padding: 0.5rem 0; text-align: right;">
                            <span id="quantity">0</span> <span id="satuan">pcs</span>
                        </td>
                    </tr>
                    <tr style="border-top: 2px solid #2e7d32;">
                        <td style="padding: 0.5rem 0; font-weight: bold; font-size: 1.2rem;">Total Bayar</td>
                        <td style="padding: 0.5rem 0; text-align: right;">
                            <span id="totalPrice" class="price" style="font-size: 1.3rem; font-weight: bold;">Rp 0</span>
                        </td>
                    </tr>
                </table>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">💾 Simpan Transaksi</button>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const productSelect = document.getElementById('product_id');
                const jumlahInput = document.getElementById('jumlah');
                const stockInfo = document.getElementById('stockInfo');
                const unitPrice = document.getElementById('unitPrice');
                const quantity = document.getElementById('quantity');
                const satuan = document.getElementById('satuan');
                const totalPrice = document.getElementById('totalPrice');

                function formatRupiah(number) {
                    return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }

                function updateSummary() {
                    const selectedOption = productSelect.options[productSelect.selectedIndex];
                    if (selectedOption.value) {
                        const price = parseFloat(selectedOption.dataset.price);
                        const stock = parseInt(selectedOption.dataset.stock);
                        const satuanValue = selectedOption.dataset.satuan;
                        const qty = parseInt(jumlahInput.value) || 0;

                        unitPrice.textContent = formatRupiah(price);
                        quantity.textContent = qty;
                        satuan.textContent = satuanValue;
                        totalPrice.textContent = formatRupiah(price * qty);
                        
                        stockInfo.textContent = `Stok tersedia: ${stock} ${satuanValue}`;
                        stockInfo.style.color = qty > stock ? '#c62828' : '#666';
                        
                        jumlahInput.max = stock;
                    } else {
                        unitPrice.textContent = 'Rp 0';
                        quantity.textContent = '0';
                        satuan.textContent = 'pcs';
                        totalPrice.textContent = 'Rp 0';
                        stockInfo.textContent = '';
                    }
                }

                productSelect.addEventListener('change', updateSummary);
                jumlahInput.addEventListener('input', updateSummary);

                // Initialize
                updateSummary();
            });
        </script>
    @endif
</div>
@endsection
