<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;

// Update semua produk yang tidak punya gambar
$products = Product::whereNull('gambar')->orWhere('gambar', '')->get();

$images = [
    'beras-pulen.jpg',
    'beras-pandan-wangi.jpg',
    'tepung-terigu.jpg',
    'tepung-beras.jpg',
    'gula-pasir.jpg',
    'gula-merah.jpg',
    'garam-dapur.jpg',
    'minyak-goreng.jpg',
    'margarin.jpg',
    'mentega.jpg',
    'susu-bubuk.jpg',
    'susu-kental.jpg',
    'kopi-bubuk.jpg',
    'teh-celup.jpg',
    'sirup.jpg',
    'air-mineral.jpg',
    'sabun-mandi.jpg',
    'sabun-cuci.jpg',
    'shampo.jpg',
    'pasta-gigi.jpg',
    'detergen.jpg',
    'pewangi.jpg',
];

foreach ($products as $index => $product) {
    $imageName = $images[$index % count($images)] ?? 'default.jpg';
    $product->update(['gambar' => 'products/' . $imageName]);
    echo "Updated: {$product->nama} -> {$imageName}\n";
}

echo "\nTotal updated: " . $products->count() . " products\n";
