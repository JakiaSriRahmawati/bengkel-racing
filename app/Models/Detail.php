<?php

namespace App\Models;
use Illuminate\Support\Str;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksis';

    protected $fillable = [
        'booking_id',
        'nama_barang',
        'harga_barang',
        'biaya_jasa',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($detail) {
            $detail->invoice = 'INV-' . now()->format('Ymd') . '-' . Str::random(6);
        });
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }


}
