<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama' => 'Beras & Tepung',
                'deskripsi' => 'Berbagai jenis beras dan tepung berkualitas',
                'aktif' => true,
            ],
            [
                'nama' => 'Minyak Goreng',
                'deskripsi' => 'Minyak goreng untuk kebutuhan memasak sehari-hari',
                'aktif' => true,
            ],
            [
                'nama' => 'Gula & Kopi',
                'deskripsi' => 'Gula pasir, gula merah, kopi dan teh',
                'aktif' => true,
            ],
            [
                'nama' => 'Bumbu Dapur',
                'deskripsi' => 'Bumbu masak dan rempah-rempah',
                'aktif' => true,
            ],
            [
                'nama' => 'Mie Instan',
                'deskripsi' => 'Berbagai merek mie instan favorit',
                'aktif' => true,
            ],
            [
                'nama' => 'Minuman',
                'deskripsi' => 'Air mineral, susu, dan minuman lainnya',
                'aktif' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
