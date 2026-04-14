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
            ['name' => 'Electronics', 'description' => 'Electronic devices and accessories'],
            ['name' => 'Clothing', 'description' => 'Apparel and fashion items'],
            ['name' => 'Food & Beverages', 'description' => 'Food items and drinks'],
            ['name' => 'Home & Garden', 'description' => 'Home improvement and garden supplies'],
            ['name' => 'Sports & Outdoors', 'description' => 'Sports equipment and outdoor gear'],
            ['name' => 'Books & Stationery', 'description' => 'Books, pens, and office supplies'],
            ['name' => 'Toys & Games', 'description' => 'Children toys and games'],
            ['name' => 'Health & Beauty', 'description' => 'Personal care and beauty products'],
            ['name' => 'Automotive', 'description' => 'Car parts and accessories'],
            ['name' => 'Furniture', 'description' => 'Home and office furniture'],
        ];

        foreach ($categories as $index => $category) {
            Category::create([
                'name' => $category['name'],
                'description' => $category['description'],
                'sort_order' => $index + 1,
                'status' => 'active',
            ]);
        }
    }
}
