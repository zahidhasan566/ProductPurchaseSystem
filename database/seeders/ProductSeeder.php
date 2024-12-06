<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Laravel Book',
            'description' => 'A comprehensive guide to Laravel.',
            'price' => 50.00,
            'stock' => 100,
        ]);
    }
}
