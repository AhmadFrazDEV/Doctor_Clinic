<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'patient_id',
        'appointment_id',
        'total_amount',
        'payment_method',
        'staff_id',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];
}
