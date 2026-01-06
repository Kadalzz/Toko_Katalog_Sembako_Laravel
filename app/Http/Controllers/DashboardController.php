<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Filter periode
        $periode = $request->get('periode', 'bulan_ini');
        
        $startDate = null;
        $endDate = now();

        switch ($periode) {
            case 'hari_ini':
                $startDate = now()->startOfDay();
                break;
            case 'minggu_ini':
                $startDate = now()->startOfWeek();
                break;
            case 'bulan_ini':
                $startDate = now()->startOfMonth();
                break;
            case 'tahun_ini':
                $startDate = now()->startOfYear();
                break;
        }

        // Query transaksi berdasarkan periode (hitung semua kecuali yang dibatalkan)
        $transactionsQuery = Transaction::whereIn('status', ['pending', 'selesai']);
        if ($startDate) {
            $transactionsQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Statistik Umum
        $totalTransaksi = $transactionsQuery->count();
        $totalPendapatan = $transactionsQuery->sum('total_harga');
        $totalProdukTerjual = $transactionsQuery->sum('jumlah');

        // Total Kategori dan Produk
        $totalKategori = Category::count();
        $totalProduk = Product::count();
        $produkStokRendah = Product::where('stok', '<', 10)->where('stok', '>', 0)->count();
        $produkHabis = Product::where('stok', 0)->count();

        // Produk Terlaris
        $produkTerlaris = Transaction::select('product_id', DB::raw('SUM(jumlah) as total_terjual'))
            ->whereIn('status', ['pending', 'selesai'])
            ->when($startDate, function($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->groupBy('product_id')
            ->orderByDesc('total_terjual')
            ->with('product.category')
            ->limit(5)
            ->get();

        // Transaksi Terbaru
        $transaksiTerbaru = Transaction::with('product.category')
            ->latest()
            ->limit(5)
            ->get();

        // Pendapatan per Hari (7 hari terakhir)
        $pendapatanHarian = Transaction::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('SUM(total_harga) as total')
            )
            ->whereIn('status', ['pending', 'selesai'])
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('dashboard', compact(
            'totalTransaksi',
            'totalPendapatan',
            'totalProdukTerjual',
            'totalKategori',
            'totalProduk',
            'produkStokRendah',
            'produkHabis',
            'produkTerlaris',
            'transaksiTerbaru',
            'pendapatanHarian',
            'periode'
        ));
    }
}
