<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_number',
        'supplier_id',
        'total_amount',
        'tax_amount',
        'discount_amount',
        'final_amount',
        'status', // 'ordered', 'in_transit', 'received', 'cancelled'
        'order_date',
        'expected_date',
        'received_date',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_amount' => 'decimal:2',
        'order_date' => 'datetime',
        'expected_date' => 'datetime',
        'received_date' => 'datetime',
    ];

    /**
     * Get the supplier for this purchase.
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get the user who created the purchase.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the purchase.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the purchase items for this purchase.
     */
    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    /**
     * Get formatted total amount.
     */
    public function getFormattedTotalAmountAttribute(): string
    {
        return 'TZS ' . number_format($this->total_amount, 2);
    }

    /**
     * Get formatted tax amount.
     */
    public function getFormattedTaxAmountAttribute(): string
    {
        return 'TZS ' . number_format($this->tax_amount, 2);
    }

    /**
     * Get formatted discount amount.
     */
    public function getFormattedDiscountAmountAttribute(): string
    {
        return 'TZS ' . number_format($this->discount_amount, 2);
    }

    /**
     * Get formatted final amount.
     */
    public function getFormattedFinalAmountAttribute(): string
    {
        return 'TZS ' . number_format($this->final_amount, 2);
    }

    /**
     * Check if purchase is ordered.
     */
    public function isOrdered(): bool
    {
        return $this->status === 'ordered';
    }

    /**
     * Check if purchase is in transit.
     */
    public function isInTransit(): bool
    {
        return $this->status === 'in_transit';
    }

    /**
     * Check if purchase is received.
     */
    public function isReceived(): bool
    {
        return $this->status === 'received';
    }

    /**
     * Check if purchase is cancelled.
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Get status label with color.
     */
    public function getStatusLabelAttribute(): string
    {
        $colors = [
            'ordered' => 'bg-blue-100 text-blue-800',
            'in_transit' => 'bg-yellow-100 text-yellow-800',
            'received' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
        ];

        $color = $colors[$this->status] ?? 'bg-gray-100 text-gray-800';

        return '<span class="px-2 py-1 ' . $color . ' text-xs rounded-full">' . ucfirst(str_replace('_', ' ', $this->status)) . '</span>';
    }

    /**
     * Scope a query to only include ordered purchases.
     */
    public function scopeOrdered($query)
    {
        return $query->where('status', 'ordered');
    }

    /**
     * Scope a query to only include in transit purchases.
     */
    public function scopeInTransit($query)
    {
        return $query->where('status', 'in_transit');
    }

    /**
     * Scope a query to only include received purchases.
     */
    public function scopeReceived($query)
    {
        return $query->where('status', 'received');
    }

    /**
     * Scope a query to only include cancelled purchases.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
}
