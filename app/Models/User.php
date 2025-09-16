<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * Check if the user can access the given Filament panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Allow all users for now
        return true;

        // Example: only allow if user is admin
        // return $this->is_admin === true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'clinic_id',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationships
     */
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function ownedClinics()
    {
        return $this->hasMany(Clinic::class, 'owner_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'staff_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'staff_id');
    }

    public function inventoryUpdates()
    {
        return $this->hasMany(InventoryItem::class, 'last_updated_by');
    }
}
