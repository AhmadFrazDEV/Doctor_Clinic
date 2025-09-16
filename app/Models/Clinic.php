<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\Expense;
use App\Models\InventoryItem;
use App\Models\Service;
use App\Models\Consent;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_id',
        'address',
        'phone',
        'subscription_plan',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function consents()
    {
        return $this->hasMany(Consent::class);
    }
}
