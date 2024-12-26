<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPembayaran extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'booking_id', 'gambar'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

   
}
