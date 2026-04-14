<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'sale_id',
        'amount',
        'payment_method',
        'payment_status',
        'notes',
        'user_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the sale that owns the payment.
     */
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Get the user who created the payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get formatted amount.
     */
    public function getFormattedAmountAttribute(): string
    {
        return App\Models\SystemSetting::getCurrencyCode() . ' ' . number_format($this->amount, 2);
    }

    /**
     * Get payment method label.
     */
    public function getPaymentMethodLabelAttribute(): string
    {
        return match($this->payment_method) {
            'cash' => '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Cash</span>',
            'card' => '<span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Card</span>',
            'mobile_money' => '<span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">Mobile Money</span>',
            'bank_transfer' => '<span class="px-2 py-1 text-xs rounded-full bg-orange-100 text-orange-800">Bank Transfer</span>',
            'credit' => '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Credit</span>',
            default => '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">' . ucfirst($this->payment_method) . '</span>',
        };
    }

    /**
     * Get payment status label.
     */
    public function getPaymentStatusLabelAttribute(): string
    {
        return match($this->payment_status) {
            'completed' => '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Completed</span>',
            'pending' => '<span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>',
            'failed' => '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Failed</span>',
            'refunded' => '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Refunded</span>',
            default => '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">' . ucfirst($this->payment_status) . '</span>',
        };
    }
}
