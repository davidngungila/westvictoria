<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sku',
        'price',
        'cost_price',
        'quantity',
        'min_quantity',
        'category',
        'brand',
        'supplier',
        'status',
        'image',
        'barcode',
        'weight',
        'dimensions',
        'notes'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'quantity' => 'integer',
        'min_quantity' => 'integer',
        'weight' => 'decimal:2',
    ];

    /**
     * Get the formatted price.
     */
    public function getFormattedPriceAttribute()
    {
        return 'TZS ' . number_format($this->price, 2);
    }

    /**
     * Get the formatted cost price.
     */
    public function getFormattedCostPriceAttribute()
    {
        return 'TZS ' . number_format($this->cost_price, 2);
    }

    /**
     * Get the profit margin.
     */
    public function getProfitMarginAttribute()
    {
        if ($this->cost_price > 0) {
            return (($this->price - $this->cost_price) / $this->price) * 100;
        }
        return 0;
    }

    /**
     * Check if product is low in stock.
     */
    public function isLowStock()
    {
        return $this->quantity <= $this->min_quantity && $this->quantity > 0;
    }

    /**
     * Generate a unique SKU based on product name and category.
     */
    public static function generateUniqueSku($name, $category = null)
    {
        // Extract first 3 letters from name (remove special characters)
        $namePrefix = preg_replace('/[^a-zA-Z0-9]/', '', $name);
        $namePrefix = strtoupper(substr($namePrefix, 0, 3));
        
        // Extract first 3 letters from category if provided
        $categoryPrefix = '';
        if ($category) {
            $categoryPrefix = preg_replace('/[^a-zA-Z0-9]/', '', $category);
            $categoryPrefix = strtoupper(substr($categoryPrefix, 0, 3));
        }
        
        // Create base SKU
        $baseSku = $namePrefix . ($categoryPrefix ? '-' . $categoryPrefix : '');
        
        // Add random 4-digit number
        $randomNumber = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $sku = $baseSku . '-' . $randomNumber;
        
        // Ensure SKU is unique
        $originalSku = $sku;
        $counter = 1;
        
        while (self::where('sku', $sku)->exists()) {
            $sku = $originalSku . '-' . $counter;
            $counter++;
        }
        
        return $sku;
    }

    /**
     * Get stock status label.
     */
    public function getStockStatusLabelAttribute()
    {
        if ($this->quantity <= 0) {
            return 'Out of Stock';
        } elseif ($this->isLowStock()) {
            return 'Low Stock';
        }
        return 'In Stock';
    }

    /**
     * Get stock status color.
     */
    public function getStockStatusColorAttribute()
    {
        if ($this->quantity <= 0) {
            return 'red';
        } elseif ($this->isLowStock()) {
            return 'yellow';
        }
        return 'green';
    }
}
