<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $fillable = ['booking_id', 'nama_barang', 'harga_barang', 'stock'];

    public function Booking()
    {
        return $this->belongsTo(booking::class);
    }

    public function DetailTransaksi()
    {
        return $this->belongsTo(detail_transaksi::class);
    }
    public function details()
{
    return $this->hasMany(Detail::class);
}
}
