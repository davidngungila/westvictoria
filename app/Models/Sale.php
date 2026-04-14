<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'sale_type', // 'retail' or 'wholesale'
        'total_amount',
        'discount_amount',
        'tax_amount',
        'final_amount',
        'payment_method', // 'cash', 'card', 'bank_transfer', 'mobile_money'
        'payment_status', // 'pending', 'paid', 'partial', 'overdue'
        'sale_status', // 'pending', 'completed', 'cancelled', 'refunded'
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'final_amount' => 'decimal:2',
        'sale_date' => 'datetime',
    ];

    /**
     * Get the user who created the sale.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the sale.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the sale items for this sale.
     */
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    /**
     * Get the payments for this sale.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get formatted total amount.
     */
    public function getFormattedTotalAmountAttribute(): string
    {
        return 'TZS ' . number_format($this->total_amount, 2);
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
     * Get formatted final amount.
     */
    public function getFormattedFinalAmountAttribute(): string
    {
        return 'TZS ' . number_format($this->final_amount, 2);
    }

    /**
     * Check if sale is retail.
     */
    public function isRetail(): bool
    {
        return $this->sale_type === 'retail';
    }

    /**
     * Check if sale is wholesale.
     */
    public function isWholesale(): bool
    {
        return $this->sale_type === 'wholesale';
    }

    /**
     * Get sale type label with color.
     */
    public function getSaleTypeLabelAttribute(): string
    {
        if ($this->isRetail()) {
            return '<span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Retail</span>';
        } elseif ($this->isWholesale()) {
            return '<span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Wholesale</span>';
        }
        
        return '<span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">' . ucfirst($this->sale_type) . '</span>';
    }

    /**
     * Get payment status label with color.
     */
    public function getPaymentStatusLabelAttribute(): string
    {
        $colors = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'paid' => 'bg-green-100 text-green-800',
            'partial' => 'bg-orange-100 text-orange-800',
            'overdue' => 'bg-red-100 text-red-800',
        ];

        $color = $colors[$this->payment_status] ?? 'bg-gray-100 text-gray-800';

        return '<span class="px-2 py-1 ' . $color . ' text-xs rounded-full">' . ucfirst($this->payment_status) . '</span>';
    }

    /**
     * Get sale status label with color.
     */
    public function getSaleStatusLabelAttribute(): string
    {
        $colors = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'refunded' => 'bg-gray-100 text-gray-800',
        ];

        $color = $colors[$this->sale_status] ?? 'bg-gray-100 text-gray-800';

        return '<span class="px-2 py-1 ' . $color . ' text-xs rounded-full">' . ucfirst($this->sale_status) . '</span>';
    }

    /**
     * Generate unique sale number.
     */
    public static function generateSaleNumber(): string
    {
        $prefix = 'SALE';
        $date = now()->format('Ymd');
        $random = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        
        $saleNumber = $prefix . '-' . $date . '-' . $random;
        
        // Ensure uniqueness
        while (self::where('sale_number', $saleNumber)->exists()) {
            $random = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $saleNumber = $prefix . '-' . $date . '-' . $random;
        }
        
        return $saleNumber;
    }

    /**
     * Scope to get only retail sales.
     */
    public function scopeRetail($query)
    {
        return $query->where('sale_type', 'retail');
    }

    /**
     * Scope to get only wholesale sales.
     */
    public function scopeWholesale($query)
    {
        return $query->where('sale_type', 'wholesale');
    }

    /**
     * Scope to get sales by status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('sale_status', $status);
    }

    /**
     * Scope to get sales by payment status.
     */
    public function scopeByPaymentStatus($query, $paymentStatus)
    {
        return $query->where('payment_status', $paymentStatus);
    }

    /**
     * Scope to get sales in date range.
     */
    public function scopeInDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }
}
