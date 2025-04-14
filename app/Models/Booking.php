<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the plural of the model name
    protected $table = 'bookings';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'user_id',  // The ID of the customer
        'room_id',  // The ID of the room booked
        'check_in_date',
        'check_out_date',
        'number_of_guests',
        'total_price',
        'status', // Booking status (e.g., confirmed, canceled)
        'special_requests'
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'total_price' => 'decimal:2'
    ];

    // Relationship with the User (customer) model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the Room model
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function calculateTotalPrice()
    {
        $nights = $this->check_in_date->diffInDays($this->check_out_date);
        return $this->room->price_per_night * $nights;
    }
}

