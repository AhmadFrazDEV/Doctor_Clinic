<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'phone',
        'email',
        'address',
        'notes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
