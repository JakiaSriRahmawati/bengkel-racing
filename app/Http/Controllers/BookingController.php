<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\booking;
use App\Models\BuktiPembayaran;
use App\Models\detail_transaksi;
use App\Models\User;

class BookingController extends Controller
{
    
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'merek_motor' => 'required|string',
            'seri_motor' => 'required|string',
            'mesin_motor' => 'required|string',
            'no_plat' => 'required|string',
            'jenis_servis' => 'required|string',
            'tanggal_booking' => 'required|date',
            'deskripsi' => 'required|string',
        ]);


         // Pastikan pengguna sudah login
         if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
        }

        // Simpan data ke database
        Booking::create([
            'user_id' => Auth::id(), // Tambahkan user_id
            'merek_motor' => $request->input('merek_motor'),
            'seri_motor' => $request->input('seri_motor'),
            'mesin_motor' => $request->input('mesin_motor'),
            'no_plat' => $request->input('no_plat'),
            'jenis_servis' => $request->input('jenis_servis'),
            'tanggal_booking' => $request->input('tanggal_booking'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        return redirect()->back()->with('success', 'Booking berhasil!');
    }

    public function pay($id)
    {
        $booking = Booking::find($id);
        
        if ($booking) {
            $booking->is_paid = true;
            $booking->save();
            return redirect()->route('profile')->with('status', 'Pembayaran berhasil.');
        }

        return redirect()->route('profile')->with('error', 'Pesanan tidak ditemukan.');
    }

    // BookingController.php
public function destroy($id)
{
    $booking = Booking::find($id);
    
    if ($booking) {
        // Hapus booking dari database
        $booking->delete();
        
        return redirect()->back()->with('status', 'Pesanan berhasil dihapus.');
    }
    
    return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
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
    'status_servis',
    'payment_proof',
    'is_paid'
];

public function user()
{
    return $this->belongsTo(User::class);
}

public function details()
{
    return $this->hasMany(detail_transaksi::class, 'booking_id');
}



}


