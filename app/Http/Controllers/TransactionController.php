<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Http\Requests\StoreTransactionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaction::with('product.category');

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', $request->date);
        }

        $transactions = $query->latest()->paginate(15);
        
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('aktif', true)
            ->where('stok', '>', 0)
            ->with('category')
            ->get();
        
        return view('transactions.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        try {
            DB::beginTransaction();

            $product = Product::findOrFail($request->product_id);

            // Cek stok
            if ($product->stok < $request->jumlah) {
                return back()->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . $product->stok . ' ' . $product->satuan);
            }

            // Hitung total harga
            $totalHarga = $product->harga * $request->jumlah;

            // Buat transaksi
            $transaction = Transaction::create([
                'product_id' => $request->product_id,
                'nama_pembeli' => $request->nama_pembeli,
                'jumlah' => $request->jumlah,
                'total_harga' => $totalHarga,
                'status' => 'selesai',
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
            ]);

            // Kurangi stok produk
            $product->decrement('stok', $request->jumlah);

            DB::commit();

            return redirect()->route('transactions.show', $transaction)
                ->with('success', 'Transaksi berhasil! Stok produk telah dikurangi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaction->load(['product.category']);
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tidak digunakan untuk transaksi
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        // Update status transaksi saja
        $request->validate([
            'status' => 'required|in:pending,selesai,batal'
        ]);

        $oldStatus = $transaction->status;
        $newStatus = $request->status;

        // Jika status berubah dari selesai ke batal, kembalikan stok
        if ($oldStatus == 'selesai' && $newStatus == 'batal') {
            $transaction->product->increment('stok', $transaction->jumlah);
        }

        // Jika status berubah dari batal ke selesai, kurangi stok
        if ($oldStatus == 'batal' && $newStatus == 'selesai') {
            if ($transaction->product->stok < $transaction->jumlah) {
                return back()->with('error', 'Stok tidak mencukupi!');
            }
            $transaction->product->decrement('stok', $transaction->jumlah);
        }

        $transaction->update(['status' => $newStatus]);

        return back()->with('success', 'Status transaksi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        // Kembalikan stok jika transaksi selesai
        if ($transaction->status == 'selesai') {
            $transaction->product->increment('stok', $transaction->jumlah);
        }

        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus dan stok dikembalikan!');
    }
}
