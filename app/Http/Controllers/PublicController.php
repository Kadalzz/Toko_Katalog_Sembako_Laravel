<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    /**
     * Halaman utama katalog produk
     */
    public function index(Request $request)
    {
        $query = Product::where('aktif', true)->where('stok', '>', 0);

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $products = $query->with('category')->paginate(12);
        $categories = Category::where('aktif', true)->withCount('products')->get();

        return view('public.index', compact('products', 'categories'));
    }

    /**
     * Detail produk
     */
    public function show($id)
    {
        $product = Product::where('aktif', true)
            ->where('id', $id)
            ->with('category')
            ->firstOrFail();

        // Produk terkait (kategori sama)
        $relatedProducts = Product::where('aktif', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stok', '>', 0)
            ->limit(4)
            ->get();

        return view('public.show', compact('product', 'relatedProducts'));
    }

    /**
     * Halaman checkout
     */
    public function checkout($id)
    {
        $product = Product::where('aktif', true)
            ->where('id', $id)
            ->where('stok', '>', 0)
            ->with('category')
            ->firstOrFail();

        return view('public.checkout', compact('product'));
    }

    /**
     * Proses order
     */
    public function order(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'nama_pembeli' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
        ], [
            'product_id.required' => 'Produk wajib dipilih.',
            'nama_pembeli.required' => 'Nama wajib diisi.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.min' => 'Jumlah minimal 1.',
            'no_telepon.required' => 'No. telepon wajib diisi.',
            'alamat.required' => 'Alamat pengiriman wajib diisi.',
        ]);

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($request->product_id);

            // Cek stok
            if ($product->stok < $request->jumlah) {
                return back()->with('error', 'Maaf, stok tidak mencukupi. Stok tersedia: ' . $product->stok . ' ' . $product->satuan);
            }

            // Hitung total
            $totalHarga = $product->harga * $request->jumlah;

            // Buat transaksi
            $transaction = Transaction::create([
                'product_id' => $request->product_id,
                'nama_pembeli' => $request->nama_pembeli,
                'jumlah' => $request->jumlah,
                'total_harga' => $totalHarga,
                'status' => 'pending',
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
            ]);

            // Kurangi stok
            $product->decrement('stok', $request->jumlah);

            DB::commit();

            return redirect()->route('public.success', $transaction->id)
                ->with('success', 'Pesanan berhasil! Kami akan segera menghubungi Anda.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Halaman sukses order
     */
    public function success($id)
    {
        $transaction = Transaction::with('product.category')->findOrFail($id);
        return view('public.success', compact('transaction'));
    }
}
