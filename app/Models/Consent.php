<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consent extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'patient_id',
        'document_type',
        'status',
        'file_path',
    ];
}
