<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'name',
        'category',
        'available_quantity',
        'min_threshold',
        'unit_price',
        'supplier',
        'expiry_date',
        'last_updated_by',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'expiry_date' => 'date',
    ];
}
