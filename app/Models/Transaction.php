<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'product_id',
        'nama_pembeli',
        'jumlah',
        'total_harga',
        'status',
        'alamat',
        'no_telepon',
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
    ];

    /**
     * Relasi BelongsTo: Transaction milik satu Product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
