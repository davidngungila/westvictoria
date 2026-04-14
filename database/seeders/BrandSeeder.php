<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Apple', 'description' => 'Technology and electronics company'],
            ['name' => 'Samsung', 'description' => 'Electronics and appliances manufacturer'],
            ['name' => 'Nike', 'description' => 'Sports apparel and footwear'],
            ['name' => 'Adidas', 'description' => 'Sports clothing and accessories'],
            ['name' => 'Sony', 'description' => 'Electronics and entertainment'],
            ['name' => 'LG', 'description' => 'Home electronics and appliances'],
            ['name' => 'Microsoft', 'description' => 'Software and technology'],
            ['name' => 'Dell', 'description' => 'Computers and technology'],
            ['name' => 'HP', 'description' => 'Computers and printing solutions'],
            ['name' => 'Canon', 'description' => 'Cameras and imaging equipment'],
            ['name' => 'Panasonic', 'description' => 'Electronics and home appliances'],
            ['name' => 'Toshiba', 'description' => 'Electronics and computers'],
        ];

        foreach ($brands as $index => $brand) {
            Brand::create([
                'name' => $brand['name'],
                'description' => $brand['description'],
                'sort_order' => $index + 1,
                'status' => 'active',
            ]);
        }
    }
}
