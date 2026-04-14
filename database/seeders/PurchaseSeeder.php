<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample suppliers if they don't exist
        $supplier1 = \App\Models\Supplier::firstOrCreate(
            ['email' => 'info@techpro.co.tz'],
            [
                'name' => 'TechPro Supplies',
                'phone' => '+255 712 345 678',
                'address' => '123 Industrial Area',
                'city' => 'Dar es Salaam',
                'supplier_id' => \App\Models\Supplier::generateSupplierId(),
                'status' => 'active',
            ]
        );

        $supplier2 = \App\Models\Supplier::firstOrCreate(
            ['email' => 'sales@globalmaterials.tz'],
            [
                'name' => 'Global Materials Ltd',
                'phone' => '+255 713 456 789',
                'address' => '456 Business Park',
                'city' => 'Dar es Salaam',
                'supplier_id' => \App\Models\Supplier::generateSupplierId(),
                'status' => 'active',
            ]
        );

        // Create sample purchases
        \App\Models\Purchase::create([
            'purchase_number' => 'PO-2026-0001',
            'supplier_id' => $supplier1->id,
            'total_amount' => 3450.00,
            'tax_amount' => 0,
            'discount_amount' => 0,
            'final_amount' => 3450.00,
            'status' => 'received',
            'order_date' => now()->subDays(2),
            'expected_date' => now()->subDays(1),
            'received_date' => now()->subDays(1),
            'notes' => 'Office supplies delivery',
            'created_by' => 1,
        ]);

        \App\Models\Purchase::create([
            'purchase_number' => 'PO-2026-0002',
            'supplier_id' => $supplier2->id,
            'total_amount' => 8750.00,
            'tax_amount' => 0,
            'discount_amount' => 0,
            'final_amount' => 8750.00,
            'status' => 'in_transit',
            'order_date' => now()->subDays(1),
            'expected_date' => now()->addDays(2),
            'notes' => 'Raw materials order',
            'created_by' => 1,
        ]);

        \App\Models\Purchase::create([
            'purchase_number' => 'PO-2026-0003',
            'supplier_id' => $supplier1->id,
            'total_amount' => 1280.00,
            'tax_amount' => 0,
            'discount_amount' => 0,
            'final_amount' => 1280.00,
            'status' => 'ordered',
            'order_date' => now(),
            'expected_date' => now()->addDays(4),
            'notes' => 'Computer equipment',
            'created_by' => 1,
        ]);
    }
}
