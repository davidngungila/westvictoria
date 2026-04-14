<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some products for sale items
        $products = Product::where('status', 'active')->get();
        
        if ($products->isEmpty()) {
            $this->command->warn('No products found. Please run ProductSeeder first.');
            return;
        }

        $sales = [
            [
                'customer_name' => 'John Smith',
                'customer_email' => 'john.smith@email.com',
                'customer_phone' => '+255 712 345 678',
                'sale_type' => 'retail',
                'total_amount' => 1299.99,
                'discount_amount' => 0,
                'tax_amount' => 233.99,
                'final_amount' => 1533.98,
                'payment_method' => 'card',
                'payment_status' => 'paid',
                'sale_status' => 'completed',
                'notes' => 'Customer satisfied with laptop purchase',
                'items' => [
                    ['product_id' => 1, 'quantity' => 1, 'unit_price' => 1299.99, 'discount_percentage' => 0],
                ]
            ],
            [
                'customer_name' => 'Mary Johnson',
                'customer_email' => 'mary.j@company.com',
                'customer_phone' => '+255 713 456 789',
                'sale_type' => 'wholesale',
                'total_amount' => 2099.95,
                'discount_amount' => 209.99,
                'tax_amount' => 340.19,
                'final_amount' => 2230.15,
                'payment_method' => 'bank_transfer',
                'payment_status' => 'paid',
                'sale_status' => 'completed',
                'notes' => 'Bulk order for office equipment',
                'items' => [
                    ['product_id' => 2, 'quantity' => 20, 'unit_price' => 29.99, 'discount_percentage' => 10],
                    ['product_id' => 3, 'quantity' => 5, 'unit_price' => 349.99, 'discount_percentage' => 5],
                ]
            ],
            [
                'customer_name' => 'David Wilson',
                'customer_email' => 'david.w@email.com',
                'customer_phone' => '+255 714 567 890',
                'sale_type' => 'retail',
                'total_amount' => 89.99,
                'discount_amount' => 0,
                'tax_amount' => 16.19,
                'final_amount' => 106.18,
                'payment_method' => 'mobile_money',
                'payment_status' => 'pending',
                'sale_status' => 'pending',
                'notes' => 'Payment expected tomorrow',
                'items' => [
                    ['product_id' => 4, 'quantity' => 1, 'unit_price' => 89.99, 'discount_percentage' => 0],
                ]
            ],
            [
                'customer_name' => 'Tech Solutions Ltd',
                'customer_email' => 'orders@techsolutions.co.tz',
                'customer_phone' => '+255 715 678 901',
                'sale_type' => 'wholesale',
                'total_amount' => 3749.75,
                'discount_amount' => 374.97,
                'tax_amount' => 607.40,
                'final_amount' => 3982.18,
                'payment_method' => 'cash',
                'payment_status' => 'paid',
                'sale_status' => 'completed',
                'notes' => 'Regular wholesale customer',
                'items' => [
                    ['product_id' => 5, 'quantity' => 50, 'unit_price' => 49.99, 'discount_percentage' => 15],
                    ['product_id' => 1, 'quantity' => 2, 'unit_price' => 1299.99, 'discount_percentage' => 10],
                ]
            ],
            [
                'customer_name' => 'Alice Brown',
                'customer_email' => 'alice.b@email.com',
                'customer_phone' => '+255 716 789 012',
                'sale_type' => 'retail',
                'total_amount' => 439.97,
                'discount_amount' => 39.99,
                'tax_amount' => 72.00,
                'final_amount' => 471.98,
                'payment_method' => 'card',
                'payment_status' => 'partial',
                'sale_status' => 'completed',
                'notes' => 'Partial payment - balance to be paid next week',
                'items' => [
                    ['product_id' => 2, 'quantity' => 3, 'unit_price' => 29.99, 'discount_percentage' => 10],
                    ['product_id' => 3, 'quantity' => 1, 'unit_price' => 349.99, 'discount_percentage' => 0],
                ]
            ],
        ];

        foreach ($sales as $saleData) {
            DB::beginTransaction();
            
            try {
                // Create sale
                $sale = Sale::create([
                    'sale_number' => Sale::generateSaleNumber(),
                    'customer_name' => $saleData['customer_name'],
                    'customer_email' => $saleData['customer_email'],
                    'customer_phone' => $saleData['customer_phone'],
                    'sale_type' => $saleData['sale_type'],
                    'total_amount' => $saleData['total_amount'],
                    'discount_amount' => $saleData['discount_amount'],
                    'tax_amount' => $saleData['tax_amount'],
                    'final_amount' => $saleData['final_amount'],
                    'payment_method' => $saleData['payment_method'],
                    'payment_status' => $saleData['payment_status'],
                    'sale_status' => $saleData['sale_status'],
                    'notes' => $saleData['notes'],
                    'created_by' => 1, // Assuming user ID 1 exists
                    'updated_by' => 1,
                ]);

                // Create sale items
                foreach ($saleData['items'] as $itemData) {
                    $product = $products->find($itemData['product_id']);
                    
                    if ($product) {
                        $subtotal = $itemData['quantity'] * $itemData['unit_price'];
                        $itemDiscount = $subtotal * ($itemData['discount_percentage'] ?? 0) / 100;
                        $afterDiscount = $subtotal - $itemDiscount;
                        $itemTax = $afterDiscount * 0.18;
                        $itemTotal = $afterDiscount + $itemTax;
                        
                        SaleItem::create([
                            'sale_id' => $sale->id,
                            'product_id' => $itemData['product_id'],
                            'product_name' => $product->name,
                            'product_sku' => $product->sku,
                            'quantity' => $itemData['quantity'],
                            'unit_price' => $itemData['unit_price'],
                            'discount_percentage' => $itemData['discount_percentage'] ?? 0,
                            'discount_amount' => $itemDiscount,
                            'tax_percentage' => 18,
                            'tax_amount' => $itemTax,
                            'total_price' => $itemTotal,
                        ]);
                    }
                }
                
                DB::commit();
                $this->command->info("Created sale: {$sale->sale_number}");
                
            } catch (\Exception $e) {
                DB::rollBack();
                $this->command->error("Failed to create sale: " . $e->getMessage());
            }
        }
    }
}
