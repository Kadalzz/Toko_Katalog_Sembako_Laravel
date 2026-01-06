<?php

use Illuminate\Support\Facades\DB;

// Array gambar sesuai nama produk
$gambarProduk = [
    'Beras Premium 5kg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=400&h=300&fit=crop',
    'Beras Pandan Wangi 5kg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=400&h=300&fit=crop',
    'Tepung Terigu Segitiga Biru 1kg' => 'https://images.unsplash.com/photo-1628749235893-6d87df5e944c?w=400&h=300&fit=crop',
    'Tepung Beras Rose Brand 500g' => 'https://images.unsplash.com/photo-1628749235893-6d87df5e944c?w=400&h=300&fit=crop',
    'Minyak Goreng Bimoli 2L' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400&h=300&fit=crop',
    'Minyak Goreng Tropical 1L' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400&h=300&fit=crop',
    'Minyak Goreng Curah 1L' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400&h=300&fit=crop',
    'Gula Pasir Gulaku 1kg' => 'https://images.unsplash.com/photo-1587735243474-c2e8f8578c83?w=400&h=300&fit=crop',
    'Gula Merah 500g' => 'https://images.unsplash.com/photo-1587735243474-c2e8f8578c83?w=400&h=300&fit=crop',
    'Kopi Kapal Api Special 165g' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=400&h=300&fit=crop',
    'Teh Celup Sariwangi 25pcs' => 'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9?w=400&h=300&fit=crop',
    'Garam Dapur Refina 500g' => 'https://images.unsplash.com/photo-1518843875459-f738682238a6?w=400&h=300&fit=crop',
    'Kecap Manis ABC 275ml' => 'https://images.unsplash.com/photo-1608797178974-15b35a64ede9?w=400&h=300&fit=crop',
    'Saos Sambal ABC 335ml' => 'https://images.unsplash.com/photo-1608797178974-15b35a64ede9?w=400&h=300&fit=crop',
    'Royco Kaldu Ayam 230g' => 'https://images.unsplash.com/photo-1596040033229-a0b3b7d1f4c1?w=400&h=300&fit=crop',
    'Indomie Goreng' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=300&fit=crop',
    'Indomie Kuah Soto' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=300&fit=crop',
    'Mie Sedaap Goreng' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=300&fit=crop',
    'Pop Mie Ayam' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=300&fit=crop',
    'Aqua 600ml' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=300&fit=crop',
    'Susu Ultra 1L' => 'https://images.unsplash.com/photo-1563636619-e9143da7973b?w=400&h=300&fit=crop',
    'Susu Kental Manis Frisian Flag 370g' => 'https://images.unsplash.com/photo-1563636619-e9143da7973b?w=400&h=300&fit=crop',
];

foreach ($gambarProduk as $nama => $gambar) {
    DB::table('products')
        ->where('nama', $nama)
        ->update(['gambar' => $gambar]);
    echo "Updated: $nama\n";
}

echo "\nSelesai! Semua produk telah diupdate dengan gambar.\n";
