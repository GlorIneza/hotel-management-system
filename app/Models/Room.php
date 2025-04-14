<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model
    protected $table = 'rooms';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'name',
        'price_per_night',
        'description',
    ];

    // You can also define relationships, accessors, mutators, etc.
}
