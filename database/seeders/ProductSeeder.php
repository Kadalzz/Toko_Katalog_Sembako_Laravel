<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Beras & Tepung
            ['category' => 'Beras & Tepung', 'nama' => 'Beras Premium 5kg', 'harga' => 75000, 'stok' => 50, 'satuan' => 'kg', 'deskripsi' => 'Beras putih premium berkualitas tinggi', 'gambar' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=400&h=300&fit=crop'],
            ['category' => 'Beras & Tepung', 'nama' => 'Beras Pandan Wangi 5kg', 'harga' => 85000, 'stok' => 30, 'satuan' => 'kg', 'deskripsi' => 'Beras pandan wangi dengan aroma harum alami', 'gambar' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=400&h=300&fit=crop'],
            ['category' => 'Beras & Tepung', 'nama' => 'Tepung Terigu Segitiga Biru 1kg', 'harga' => 15000, 'stok' => 100, 'satuan' => 'kg', 'deskripsi' => 'Tepung terigu protein sedang', 'gambar' => 'https://images.unsplash.com/photo-1628749235893-6d87df5e944c?w=400&h=300&fit=crop'],
            ['category' => 'Beras & Tepung', 'nama' => 'Tepung Beras Rose Brand 500g', 'harga' => 12000, 'stok' => 80, 'satuan' => 'bungkus', 'deskripsi' => 'Tepung beras untuk kue tradisional', 'gambar' => 'https://images.unsplash.com/photo-1628749235893-6d87df5e944c?w=400&h=300&fit=crop'],
            
            // Minyak Goreng
            ['category' => 'Minyak Goreng', 'nama' => 'Minyak Goreng Bimoli 2L', 'harga' => 38000, 'stok' => 60, 'satuan' => 'botol', 'deskripsi' => 'Minyak goreng sawit berkualitas', 'gambar' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400&h=300&fit=crop'],
            ['category' => 'Minyak Goreng', 'nama' => 'Minyak Goreng Tropical 1L', 'harga' => 18000, 'stok' => 45, 'satuan' => 'botol', 'deskripsi' => 'Minyak goreng kemasan praktis', 'gambar' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400&h=300&fit=crop'],
            ['category' => 'Minyak Goreng', 'nama' => 'Minyak Goreng Curah 1L', 'harga' => 15000, 'stok' => 100, 'satuan' => 'liter', 'deskripsi' => 'Minyak goreng ekonomis', 'gambar' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400&h=300&fit=crop'],
            
            // Gula & Kopi
            ['category' => 'Gula & Kopi', 'nama' => 'Gula Pasir Gulaku 1kg', 'harga' => 18000, 'stok' => 80, 'satuan' => 'kg', 'deskripsi' => 'Gula pasir kristal putih bersih', 'gambar' => 'https://images.unsplash.com/photo-1587735243474-c2e8f8578c83?w=400&h=300&fit=crop'],
            ['category' => 'Gula & Kopi', 'nama' => 'Gula Merah 500g', 'harga' => 15000, 'stok' => 40, 'satuan' => 'bungkus', 'deskripsi' => 'Gula merah asli untuk masakan', 'gambar' => 'https://images.unsplash.com/photo-1587735243474-c2e8f8578c83?w=400&h=300&fit=crop'],
            ['category' => 'Gula & Kopi', 'nama' => 'Kopi Kapal Api Special 165g', 'harga' => 22000, 'stok' => 55, 'satuan' => 'bungkus', 'deskripsi' => 'Kopi bubuk pilihan', 'gambar' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=400&h=300&fit=crop'],
            ['category' => 'Gula & Kopi', 'nama' => 'Teh Celup Sariwangi 25pcs', 'harga' => 8000, 'stok' => 70, 'satuan' => 'dus', 'deskripsi' => 'Teh celup praktis dan nikmat', 'gambar' => 'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9?w=400&h=300&fit=crop'],
            
            // Bumbu Dapur
            ['category' => 'Bumbu Dapur', 'nama' => 'Garam Dapur Refina 500g', 'harga' => 5000, 'stok' => 120, 'satuan' => 'bungkus', 'deskripsi' => 'Garam beryodium halus', 'gambar' => 'https://images.unsplash.com/photo-1518843875459-f738682238a6?w=400&h=300&fit=crop'],
            ['category' => 'Bumbu Dapur', 'nama' => 'Kecap Manis ABC 275ml', 'harga' => 15000, 'stok' => 65, 'satuan' => 'botol', 'deskripsi' => 'Kecap manis kualitas premium', 'gambar' => 'https://images.unsplash.com/photo-1608797178974-15b35a64ede9?w=400&h=300&fit=crop'],
            ['category' => 'Bumbu Dapur', 'nama' => 'Saos Sambal ABC 335ml', 'harga' => 14000, 'stok' => 50, 'satuan' => 'botol', 'deskripsi' => 'Saos sambal pedas nikmat', 'gambar' => 'https://images.unsplash.com/photo-1608797178974-15b35a64ede9?w=400&h=300&fit=crop'],
            ['category' => 'Bumbu Dapur', 'nama' => 'Royco Kaldu Ayam 230g', 'harga' => 12000, 'stok' => 90, 'satuan' => 'bungkus', 'deskripsi' => 'Penyedap rasa kaldu ayam', 'gambar' => 'https://images.unsplash.com/photo-1596040033229-a0b3b7d1f4c1?w=400&h=300&fit=crop'],
            
            // Mie Instan
            ['category' => 'Mie Instan', 'nama' => 'Indomie Goreng', 'harga' => 3500, 'stok' => 200, 'satuan' => 'pcs', 'deskripsi' => 'Mie goreng favorit Indonesia', 'gambar' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=300&fit=crop'],
            ['category' => 'Mie Instan', 'nama' => 'Indomie Kuah Soto', 'harga' => 3500, 'stok' => 150, 'satuan' => 'pcs', 'deskripsi' => 'Mie kuah rasa soto', 'gambar' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=300&fit=crop'],
            ['category' => 'Mie Instan', 'nama' => 'Mie Sedaap Goreng', 'harga' => 3200, 'stok' => 180, 'satuan' => 'pcs', 'deskripsi' => 'Mie goreng dengan bumbu khas', 'gambar' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=300&fit=crop'],
            ['category' => 'Mie Instan', 'nama' => 'Pop Mie Ayam', 'harga' => 5500, 'stok' => 100, 'satuan' => 'pcs', 'deskripsi' => 'Mie cup praktis rasa ayam', 'gambar' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=300&fit=crop'],
            
            // Minuman
            ['category' => 'Minuman', 'nama' => 'Aqua 600ml', 'harga' => 4000, 'stok' => 300, 'satuan' => 'botol', 'deskripsi' => 'Air mineral berkualitas', 'gambar' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=300&fit=crop'],
            ['category' => 'Minuman', 'nama' => 'Susu Ultra 1L', 'harga' => 18000, 'stok' => 40, 'satuan' => 'botol', 'deskripsi' => 'Susu UHT full cream', 'gambar' => 'https://images.unsplash.com/photo-1563636619-e9143da7973b?w=400&h=300&fit=crop'],
            ['category' => 'Minuman', 'nama' => 'Susu Kental Manis Frisian Flag 370g', 'harga' => 14000, 'stok' => 75, 'satuan' => 'kaleng', 'deskripsi' => 'Susu kental manis berkualitas', 'gambar' => 'https://images.unsplash.com/photo-1563636619-e9143da7973b?w=400&h=300&fit=crop'],
        ];

        foreach ($products as $product) {
            $category = Category::where('nama', $product['category'])->first();
            if ($category) {
                Product::create([
                    'category_id' => $category->id,
                    'nama' => $product['nama'],
                    'harga' => $product['harga'],
                    'stok' => $product['stok'],
                    'satuan' => $product['satuan'],
                    'deskripsi' => $product['deskripsi'],
                    'gambar' => $product['gambar'],
                    'aktif' => true,
                ]);
            }
        }
    }
}
