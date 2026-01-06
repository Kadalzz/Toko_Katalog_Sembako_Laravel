<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;

// Daftar gambar yang lebih lengkap dan valid
$productImages = [
    // Beras & Tepung
    'Beras' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=400&h=400&fit=crop',
    'Tepung' => 'https://images.unsplash.com/photo-1628749235893-6d87df5e944c?w=400&h=400&fit=crop',
    
    // Minyak & Gula
    'Minyak' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400&h=400&fit=crop',
    'Gula' => 'https://images.unsplash.com/photo-1587735243474-c2e8f8578c83?w=400&h=400&fit=crop',
    
    // Minuman
    'Kopi' => 'https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=400&h=400&fit=crop',
    'Teh' => 'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9?w=400&h=400&fit=crop',
    'Aqua' => 'https://images.unsplash.com/photo-1548839140-29a749e1cf4d?w=400&h=400&fit=crop',
    'Susu' => 'https://images.unsplash.com/photo-1563636619-e9143da7973b?w=400&h=400&fit=crop',
    
    // Bumbu & Penyedap
    'Garam' => 'https://images.unsplash.com/photo-1518843875459-f738682238a6?w=400&h=400&fit=crop',
    'Kecap' => 'https://images.unsplash.com/photo-1608797178974-15b35a64ede9?w=400&h=400&fit=crop',
    'Saos' => 'https://images.unsplash.com/photo-1608797178974-15b35a64ede9?w=400&h=400&fit=crop',
    'Royco' => 'https://images.unsplash.com/photo-1596040033229-a0b3b7d1f4c1?w=400&h=400&fit=crop',
    
    // Mie Instan
    'Indomie' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=400&fit=crop',
    'Mie' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=400&fit=crop',
    'Pop Mie' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=400&fit=crop',
];

$products = Product::all();

foreach ($products as $product) {
    $imageUrl = null;
    
    // Cari keyword yang cocok dengan nama produk
    foreach ($productImages as $keyword => $url) {
        if (stripos($product->nama, $keyword) !== false) {
            $imageUrl = $url;
            break;
        }
    }
    
    // Jika tidak ada yang cocok, gunakan gambar default sembako
    if (!$imageUrl) {
        $imageUrl = 'https://images.unsplash.com/photo-1588964895597-cfccd6e2dbf9?w=400&h=400&fit=crop';
    }
    
    $product->update(['gambar' => $imageUrl]);
    echo "✓ Updated: {$product->nama}\n";
}

echo "\nTotal updated: " . $products->count() . " products\n";
