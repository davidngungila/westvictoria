<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'city',
        'customer_id',
        'status',
        'total_purchases',
        'total_orders',
    ];

    protected $casts = [
        'total_purchases' => 'decimal:2',
        'total_orders' => 'integer',
    ];

    public static function generateCustomerId()
    {
        $latestCustomer = self::orderBy('id', 'desc')->first();
        if (!$latestCustomer) {
            return 'CUST-001';
        }
        
        $lastId = $latestCustomer->customer_id;
        $number = (int) str_replace('CUST-', '', $lastId);
        $newNumber = $number + 1;
        
        return 'CUST-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
