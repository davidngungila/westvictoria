<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id',
        'product_name',
        'product_sku',
        'quantity',
        'unit_price',
        'discount_percentage',
        'discount_amount',
        'tax_percentage',
        'tax_amount',
        'total_price',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_percentage' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the sale that owns the sale item.
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Get the product for this sale item.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get formatted unit price.
     */
    public function getFormattedUnitPriceAttribute(): string
    {
        return 'TZS ' . number_format($this->unit_price, 2);
    }

    /**
     * Get formatted discount amount.
     */
    public function getFormattedDiscountAmountAttribute(): string
    {
        return 'TZS ' . number_format($this->discount_amount, 2);
    }

    /**
     * Get formatted tax amount.
     */
    public function getFormattedTaxAmountAttribute(): string
    {
        return 'TZS ' . number_format($this->tax_amount, 2);
    }

    /**
     * Get formatted total price.
     */
    public function getFormattedTotalPriceAttribute(): string
    {
        return 'TZS ' . number_format($this->total_price, 2);
    }

    /**
     * Calculate total price based on quantity, unit price, discount, and tax.
     */
    public function calculateTotalPrice(): void
    {
        $subtotal = $this->quantity * $this->unit_price;
        
        // Calculate discount
        $this->discount_amount = $subtotal * ($this->discount_percentage / 100);
        $afterDiscount = $subtotal - $this->discount_amount;
        
        // Calculate tax using system tax rate if tax is enabled
        $taxRate = 0;
        if (\App\Models\SystemSetting::isTaxEnabled()) {
            $taxRate = \App\Models\SystemSetting::getTaxRate();
        }
        $this->tax_amount = $afterDiscount * ($taxRate / 100);
        $this->tax_percentage = $taxRate;
        
        // Final total
        $this->total_price = $afterDiscount + $this->tax_amount;
        
        $this->save();
    }
}
