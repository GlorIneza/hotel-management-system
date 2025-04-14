<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Define the attributes that are mass assignable
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Define the relationships with the booking model
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }
}
