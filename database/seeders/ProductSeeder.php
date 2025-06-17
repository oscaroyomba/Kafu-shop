<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Disable foreign key checks to avoid constraint errors when truncating
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // ✅ Clear the products table
        Product::truncate();

        // ✅ Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ✅ Seed sample products
        Product::create([
            'name' => 'Sunshine Cooking Oil',
            'price' => 450,
            'description' => 'Pure sunflower oil - 5L',
            'image' => 'products/oil.jpg',
            'category' => 'Pantry',
        ]);

        Product::create([
            'name' => 'Wheat Flour 2kg',
            'price' => 230,
            'description' => 'Premium all-purpose wheat flour.',
            'image' => 'products/flour.jpg',
            'category' => 'Pantry',
        ]);

        Product::create([
            'name' => 'Fresh Milk 1L',
            'price' => 90,
            'description' => 'Fresh cow milk from the farm.',
            'image' => 'products/milk.jpg',
            'category' => 'Dairy',
        ]);
    }
}