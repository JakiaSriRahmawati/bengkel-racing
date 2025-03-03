<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Barang()
    {
        return $this->hasMany(barang::class);
    }

    protected $table = 'detail_transaksis'; 

    protected $fillable = [
        'booking_id',
        'invoice',
        'nama_barang',
        'harga_barang',
        'biaya_jasa',
    ];
    public function getTotalBiayaAttribute()
    {
        return $this->biaya_jasa + $this->harga_barang;
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    
}
