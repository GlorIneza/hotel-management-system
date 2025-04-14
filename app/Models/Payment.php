<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'amount',
        'payment_date',
        'payment_method', // e.g., Credit Card, PayPal
        'status', // e.g., Paid, Pending, Failed
    ];

    // Relationship with the booking model
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
