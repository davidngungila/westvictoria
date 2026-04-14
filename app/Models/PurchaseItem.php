<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'received_quantity',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'received_quantity' => 'integer',
    ];

    /**
     * Get the purchase for this purchase item.
     */
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * Get the product for this purchase item.
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
     * Get formatted total price.
     */
    public function getFormattedTotalPriceAttribute(): string
    {
        return 'TZS ' . number_format($this->total_price, 2);
    }

    /**
     * Check if the item is fully received.
     */
    public function isFullyReceived(): bool
    {
        return $this->received_quantity >= $this->quantity;
    }

    /**
     * Check if the item is partially received.
     */
    public function isPartiallyReceived(): bool
    {
        return $this->received_quantity > 0 && $this->received_quantity < $this->quantity;
    }

    /**
     * Check if the item is not received.
     */
    public function isNotReceived(): bool
    {
        return $this->received_quantity === 0;
    }
}
