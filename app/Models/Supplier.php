<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'city',
        'supplier_id',
        'status',
        'total_purchases',
        'total_orders',
        'notes',
    ];

    protected $casts = [
        'total_purchases' => 'decimal:2',
        'total_orders' => 'integer',
    ];

    public static function generateSupplierId()
    {
        $latestSupplier = self::orderBy('id', 'desc')->first();
        if (!$latestSupplier) {
            return 'SUP-001';
        }
        
        $lastId = $latestSupplier->supplier_id;
        $number = (int) str_replace('SUP-', '', $lastId);
        $newNumber = $number + 1;
        
        return 'SUP-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
