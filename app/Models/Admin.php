<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'admins';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'user_id', // You can link it to the user model if needed
        'role',    // Define roles (e.g., super admin, regular admin)
    ];

    // Relationship with the User model (if you are using a single users table)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
