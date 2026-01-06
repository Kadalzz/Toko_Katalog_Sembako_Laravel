<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;

// Cek semua produk
$products = Product::all();

echo "Total Products: " . $products->count() . "\n\n";

foreach ($products as $product) {
    $gambarStatus = $product->gambar ? "✓ {$product->gambar}" : "✗ NULL/EMPTY";
    echo "{$product->id}. {$product->nama} -> {$gambarStatus}\n";
}
