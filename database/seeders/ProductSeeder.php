<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Laptop Pro 15"',
                'description' => 'High-performance laptop with advanced features for professionals',
                'sku' => 'LP-15-2024',
                'price' => 1299.99,
                'cost_price' => 950.00,
                'quantity' => 45,
                'min_quantity' => 10,
                'category' => 'Electronics',
                'brand' => 'TechPro',
                'supplier' => 'Supplier A',
                'status' => 'active',
                'weight' => 2.1,
                'dimensions' => '35.5 × 23.5 × 1.8 cm',
                'barcode' => '1234567890123',
                'notes' => 'Popular among corporate clients',
            ],
            [
                'name' => 'Wireless Mouse',
                'description' => 'Ergonomic wireless mouse with precision tracking',
                'sku' => 'WM-001-2024',
                'price' => 29.99,
                'cost_price' => 15.00,
                'quantity' => 8,
                'min_quantity' => 15,
                'category' => 'Electronics',
                'brand' => 'TechPro',
                'supplier' => 'Supplier B',
                'status' => 'active',
                'weight' => 0.15,
                'dimensions' => '10 × 6 × 3.5 cm',
                'barcode' => '1234567890124',
                'notes' => 'Best seller in accessories category',
            ],
            [
                'name' => 'Office Chair',
                'description' => 'Ergonomic office chair with lumbar support',
                'sku' => 'OC-ERG-2024',
                'price' => 349.99,
                'cost_price' => 200.00,
                'quantity' => 120,
                'min_quantity' => 20,
                'category' => 'Furniture',
                'brand' => 'ComfortPlus',
                'supplier' => 'Supplier C',
                'status' => 'active',
                'weight' => 15.5,
                'dimensions' => '65 × 65 × 120 cm',
                'barcode' => '1234567890125',
                'notes' => 'Premium quality materials',
            ],
            [
                'name' => 'Coffee Maker',
                'description' => 'Automatic coffee machine with multiple brewing options',
                'sku' => 'CM-AUTO-2024',
                'price' => 89.99,
                'cost_price' => 55.00,
                'quantity' => 0,
                'min_quantity' => 5,
                'category' => 'Appliances',
                'brand' => 'BrewMaster',
                'supplier' => 'Supplier D',
                'status' => 'inactive',
                'weight' => 3.2,
                'dimensions' => '30 × 25 × 40 cm',
                'barcode' => '1234567890126',
                'notes' => 'Currently out of stock',
            ],
            [
                'name' => 'USB-C Hub',
                'description' => 'Multi-port USB-C hub with HDMI and SD card reader',
                'sku' => 'USB-HUB-2024',
                'price' => 49.99,
                'cost_price' => 25.00,
                'quantity' => 75,
                'min_quantity' => 25,
                'category' => 'Electronics',
                'brand' => 'ConnectPro',
                'supplier' => 'Supplier A',
                'status' => 'active',
                'weight' => 0.08,
                'dimensions' => '12 × 4 × 2 cm',
                'barcode' => '1234567890127',
                'notes' => 'Compatible with all modern laptops',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
