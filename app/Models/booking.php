<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    // protected $guarded = ['id'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }

    public function Barang()
    {
        return $this->hasMany(barang::class);
    }

    protected $fillable = [
        'user_id',
        'merek_motor',
        'seri_motor',
        'mesin_motor',
        'no_plat',
        'jenis_servis',
        'tanggal_booking',
        'deskripsi',
    ];

    protected $dates = ['tanggal_booking'];

    public function DetailTransaksi()
    {
        return $this->hasMany(detail_transaksi::class);
    }
    
    public function buktiPembayaran()
    {
        return $this->hasOne(BuktiPembayaran::class, 'booking_id')->latestOfMany();
    }



    public function details()
{
    return $this->hasMany(Detail::class);
}
    

}
