<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'booking_id',
        'rating',
        'deskripsi'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Booking()
    {
        return $this->belongsTo(booking::class);
    }
}
