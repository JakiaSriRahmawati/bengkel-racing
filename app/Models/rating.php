<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id', 'user_id', 'rating', 'review'
    ];

    // Relasi dengan model Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Relasi dengan model User (jika diperlukan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
